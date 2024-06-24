<?php

namespace App\Modules\Users\Repositories;

use App\Modules\Users\Models\User;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function all()
    {
        return User::all();
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(array $data, $id)
    {
        $item = User::findOrFail($id);
        $item->update($data);
        return $item;
    }

    public function delete($id)
    {
        $item = User::findOrFail($id);
        $item->delete();
    }

    public function find($id)
    {
        return User::findOrFail($id);
    }

    /**
     * Buscar usuarios
     *
     * @param Collection $options
     * @return Users
     */
    public function search(Collection $options)
    {
        $users = User::query();

        if ($options->has('username')) {
            
            $username = $options->get("username");
            
            $users->where('username','LIKE',"%{$username}%");
        }

        return $users->get();
    }
}
