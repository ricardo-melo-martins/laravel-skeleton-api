<?php

namespace App\Modules\Players\Repositories;

use App\Modules\Players\Models\Players;

class PlayerRepository implements PlayerRepositoryInterface
{
    public function all()
    {
        return Players::all();
    }

    public function create(array $data)
    {
        return Players::create($data);
    }

    public function update(array $data, $id)
    {
        $item = Players::findOrFail($id);
        $item->update($data);
        return $item;
    }

    public function delete($id)
    {
        $item = Players::findOrFail($id);
        $item->delete();
    }

    public function find($id)
    {
        return Players::findOrFail($id);
    }
}
