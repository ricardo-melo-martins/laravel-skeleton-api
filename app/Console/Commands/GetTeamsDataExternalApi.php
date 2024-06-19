<?php

namespace App\Console\Commands;

use App\Modules\Teams\Models\Teams;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GetTeamsDataExternalApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-teams-data-external-api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Buscar dados na api externa';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::debug($this->description);
        
        $url = env('API_EXTERNAL_URL').'/v1/teams';
        $token = env('API_AUTHORIZATION');
        
        $response = Http::withHeaders([
            'Authorization' =>  $token,
            'Content-Type' => 'application/json' 
       ])->get($url);

        if($response->successful()) {
            
            $data = $response->json();

            //Log::debug($data);
            //:TODO dto e sanitizar
            $item = new Teams();
            $item->conference =  $data['conference'];
            $item->division=  $data['division'];
            $item->city=  $data['city'];
            $item->name=  $data['name'];
            $item->full_name=  $data['full_name'];
            $item->abbreviation=  $data['abbreviation'];

            $item->save();
            
            
        } else {
            Log::error("Erro na importação dos dados da api {$url}");
        }

        
    }
}
