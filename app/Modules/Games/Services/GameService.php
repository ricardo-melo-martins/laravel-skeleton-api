<?php

namespace App\Modules\Games\Services;

use App\Modules\Games\Repositories\GameRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class GameService{
    public function __construct(
        protected GameRepository $gameRepository
    ) {
    }

    public function create(array $data)
    {
        return $this->gameRepository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->gameRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->gameRepository->delete($id);
    }

    public function all()
    {
        return $this->gameRepository->all();
    }
    
    public function find($id)
    {
        return $this->gameRepository->find($id);
    }

    public function search(Collection $options)
    {
        if(!$options->isEmpty())
        {
            // ajustar para passar a busca necessaria
            
            $filterOptions = collect([
                "final" => Str::lower($options->get("q")),
            ]);

            return $this->gameRepository->search($filterOptions);
        }
    
        // TODO: ajustar limite de registros
        return $this->gameRepository->all();    
    }
}
