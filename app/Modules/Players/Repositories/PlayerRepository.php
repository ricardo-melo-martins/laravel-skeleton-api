<?php

namespace App\Modules\Players\Repositories;

use App\Modules\Players\Models\Players;
use Illuminate\Support\Collection;

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

    /**
     * Buscar jogadores
     *
     * @param Collection $options
     * @return Players
     */
    public function search(Collection $options)
    {
        $players = Players::query();

        if ($options->has('college')) {
            
            $college = $options->get("college");
            
            $players->where('college','LIKE',"%{$college}%");
        }

        return $players->get();
    }
}
