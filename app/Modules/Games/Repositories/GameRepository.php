<?php

namespace App\Modules\Games\Repositories;
use App\Modules\Games\Models\Games;
use Illuminate\Support\Collection;

class GameRepository implements GameRepositoryInterface
{
    public function all()
    {
        return Games::all();
    }

    public function create(array $data)
    {
        return Games::create($data);
    }

    public function update(array $data, $id)
    {
        $item = Games::findOrFail($id);
        $item->update($data);
        return $item;
    }

    public function delete($id)
    {
        $item = Games::findOrFail($id);
        $item->delete();
    }

    public function find($id)
    {
        return Games::findOrFail($id);
    }

        /**
     * Buscar jogadores
     *
     * @param Collection $options
     * @return Games
     */
    public function search(Collection $options)
    {
        $games = Games::query();

        if ($options->has('college')) {
            
            $college = $options->get("college");
            
            $games->where('college','LIKE',"%{$college}%");
        }

        return $games->get();
    }
}
