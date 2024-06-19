<?php

namespace App\Modules\Teams\Repositories;

use App\Modules\Teams\Models\Teams;

class TeamRepository implements TeamRepositoryInterface
{
    public function all()
    {
        return Teams::all();
    }

    public function create(array $data)
    {
        return Teams::create($data);
    }

    public function update(array $data, $id)
    {
        $item = Teams::findOrFail($id);
        $item->update($data);
        return $item;
    }

    public function delete($id)
    {
        $item = Teams::findOrFail($id);
        $item->delete();
    }

    public function find($id)
    {
        return Teams::findOrFail($id);
    }
}
