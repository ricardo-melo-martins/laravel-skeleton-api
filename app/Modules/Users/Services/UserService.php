<?php

namespace App\Modules\Users\Services;

use App\Modules\Users\Repositories\UserRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class UserService{
    public function __construct(
        protected UserRepository $userRepository
    ) {
    }

    public function create(array $data)
    {
        return $this->userRepository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->userRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->userRepository->delete($id);
    }

    public function all()
    {
        return $this->userRepository->all();
    }
    
    public function find($id)
    {
        return $this->userRepository->find($id);
    }

    public function search(Collection $options)
    {
        if(!$options->isEmpty())
        {
            // ajustar para passar a busca necessaria
            
            $filterOptions = collect([
                "username" => Str::lower($options->get("q")),
            ]);

            return $this->userRepository->search($filterOptions);
        }
    
        // TODO: ajustar limite de registros
        return $this->userRepository->all();    
    }
}
