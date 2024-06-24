<?php

namespace App\Modules\Players\Services;

use App\Modules\Players\Repositories\PlayerRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class PlayerService
{
    public function __construct(
        protected PlayerRepository $playerRepository
    ) {
    }

    public function create(array $data)
    {
        return $this->playerRepository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->playerRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->playerRepository->delete($id);
    }

    public function all()
    {
        return $this->playerRepository->all();
    }
    
    public function find($id)
    {
        return $this->playerRepository->find($id);
    }

    public function search(Collection $options)
    {
        if(!$options->isEmpty())
        {
            // ajustar para passar a busca necessaria
            
            $filterOptions = collect([
                "college" => Str::lower($options->get("q")),
            ]);

            return $this->playerRepository->search($filterOptions);
        }
    
        // TODO: ajustar limite de registros
        return $this->playerRepository->all();    
    }
}
