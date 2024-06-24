<?php

namespace App\Modules\Teams\Services;

use App\Modules\Teams\Dtos\TeamCreateDto;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TeamHttpExternalService
{
    protected $statisticas = [];

    public function __construct(
        protected TeamService $teamService
    ) {
    }

    /**
     * Salva registros de times importados de um serviço externo
     *
     * @return void
     */
    public function saveTeamsOnDatabaseOrFail(): void
    {
        try {
            // busca dados em api externa
            $teamsDataCollection = $this->httpRequestExternalData();
            
            // avalia se dados esta de acordo para salvar na base senao falha
            $this->evaluateAndUpdateTeamsOrFail($teamsDataCollection);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Obter dados de times em uma api integração
     *
     * @return Collection
     */
    private function httpRequestExternalData(): Collection
    {
        $url = env('API_EXTERNAL_URL').'/v1/teams';
        $token = env('API_AUTHORIZATION');
        
        try {

            $response = Http::withHeaders([
                'Authorization' =>  $token,
                'Content-Type' => 'application/json' 
            ])->get($url);
            
            $httpStatusCode = $response->status();

            if($response->successful()) {

                $responseData = $response->json();

                if(isset($responseData['data']) && is_array($responseData['data'])){
                        
                    return collect($responseData['data']);        
                }

                throw new \Exception("Erro de processamento na resposta da Api");
            }

            throw new \Exception("Erro {$httpStatusCode} de processamento na Api externa {$url}");

        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }

    /**
     * Undocumented function
     *
     * @param Collection $teams
     * @return Collection
     * 
     * @throws Throwable
     */
    private function evaluateAndUpdateTeamsOrFail(Collection $teams): Collection
    {
        Log::debug("IDS encontrados na api externa para salvar: {$teams->count()}");

        // avaliar quais dos ids fornecidos ja existem no banco
        $teamsOnDB = DB::table('teams')
        ->whereIn('external_team_id', $teams->pluck('id')->toArray())
        ->get(['external_team_id']);

        // avaliar quais ids serao atualizados
        $teamsDifference = collect($teams->pluck('id')->toArray())
        ->diff(collect($teamsOnDB->pluck('external_team_id')->toArray()));

        Log::debug("IDS encontrados para salvar: {$teamsDifference->count()}");
        Log::debug($teamsDifference->values());
        
        //se nao existe dados para importar entao termine
        if($teamsDifference->count() === 0) {
            Log::debug("Nao faca nada");
            return collect([]);
        }
        
        $teamsCollection = $teams->map(function (?array $team) use ($teamsDifference) {
            
            // ignora registros com ids existentes no banco
            if(in_array($team['id'], $teamsDifference->toArray()))
            {
                $itemToSave = TeamCreateDto::from($team)->additional([
                    'external_team_id' => $team['id'] ?? null,
                ]);

                return $itemToSave;
            }
            
        })->reject(function (mixed $team) {
            // remove registros ignorados
            return $team == null;
        });

        if ($teamsCollection->count() > 0) {
            
            try {
            
                $teamsCreated = collect($this->teamService->createAll($teamsCollection->toArray()));
    
            } catch (\Throwable $th) {
                throw $th;
            }
    
            Log::debug("Itens criados");
            Log::debug($teamsCreated->pluck('id'));
    
            // retorna os ids criados
            return $teamsCreated->pluck('id');
        }

        return collect([]);
        
        
    }

}
