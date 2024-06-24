<?php

namespace App\Console\Commands;

use App\Modules\Teams\Services\TeamHttpExternalService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GetTeamsDataExternalApi extends Command
{
    private TeamHttpExternalService $teamExternalService;

    public function __construct(TeamHttpExternalService $teamExternalService)
    {
        $this->teamExternalService = $teamExternalService;
        parent::__construct();
    }
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
    public function handle(): void
    {
        Log::debug("JOB {$this->signature} iniciado :: {$this->description}");
        
        try {
            
            $this->teamExternalService->saveTeamsOnDatabaseOrFail();    

        } catch (\Throwable $th) {
            Log::error("JOB falhou :: {$th->getMessage()}");
        }

        Log::debug("JOB {$this->signature} terminado ");
    }
      
}
