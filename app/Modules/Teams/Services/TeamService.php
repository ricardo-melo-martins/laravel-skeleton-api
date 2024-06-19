<?php

namespace App\Modules\Teams\Services;

use App\Modules\Teams\Repositories\TeamRepository;

class TeamService
{
    public function __construct(
        protected TeamRepository $teamRepository
    ) {
    }

    public function create(array $data)
    {
        return $this->teamRepository->create($data);
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
    
    public function find($id)
    {
        return $this->teamRepository->find($id);
    }
}
