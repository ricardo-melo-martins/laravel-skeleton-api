<?php

namespace App\Modules\Teams\Services;

use App\Modules\Teams\Dtos\TeamCreateDto;
use App\Modules\Teams\Dtos\TeamReadDto;
use App\Modules\Teams\Repositories\TeamRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeamService
{
    public function __construct(
        protected TeamRepository $teamRepository
    ) {
    }

    public function create(array $data)
    {
        $teamDto = TeamCreateDto::from($data);
                
        return $this->teamRepository->create($teamDto->toArray());
    }

    public function update(array $data, $id)
    {
        return $this->teamRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->teamRepository->delete($id);
    }

    public function all()
    {
        return $this->teamRepository->all();
    }
    
    public function find(int $id): ?TeamReadDto
    {
        $modelData = $this->teamRepository->find($id);
        
        if(!$modelData){
            return null;
        }

        return TeamReadDto::from($modelData);
    }

    public function createAll(array $data): array 
    {
        $items = [];
        
        DB::beginTransaction();

        try {
            foreach ($data as $item) {
            
                $items[] = $this->create($item);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            
            throw $e;
        }

        
        $itemCollection = collect($items);

        if($itemCollection->isNotEmpty()){
            $items = $itemCollection->pluck('id');
        }

        return $items;
        
    }

    public function search(Collection $options)
    {
        if(!$options->isEmpty())
        {
            // ajustar para passar a busca necessaria
            
            $filterOptions = collect([
                "full_name" => Str::lower($options->get("q")),
            ]);

            return $this->teamRepository->search($filterOptions);
        }
    
        // TODO: ajustar limite de registros
        return $this->teamRepository->all();    
    }
    
}
