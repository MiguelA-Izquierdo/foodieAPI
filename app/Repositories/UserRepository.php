<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use App\Models\User;

class UserRepository
{
    public function getAll()
    {
        try {
            return User::all();
        } catch (\Exception $error) {
            Log::error($error);
            throw new \Exception('Error al obtener todos los usuarios');
        }
    }

    public function getById($id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                throw new \Exception('Usuario no encontrado');
            }
            return $user;
        } catch (\Exception $error) {
            Log::error($error);
            throw new \Exception('Error al obtener el usuario por ID');
        }
    }

    public function create($newData)
    {
        try {
            return User::create($newData);
        } catch (\Exception $error) {
            Log::error($error);
            throw new \Exception('Error al crear el usuario');
        }
    }

    public function update($id, array $newData)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                throw new \Exception('Usuario no encontrado');
            }

            $user->update($newData);
            return $user;
        } catch (\Exception $error) {
            Log::error($error);
            throw new \Exception('Error al actualizar el usuario');
        }
    }

    public function delete($id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                throw new \Exception('Usuario no encontrado');
            }

            $user->delete();
        } catch (\Exception $error) {
            Log::error($error);
            throw new \Exception('Error al eliminar el usuario');
        }
    }

    public function find(array $criteria)
    {
        try {
            return User::where($criteria)->get();
        } catch (\Exception $error) {
            Log::error($error);
            throw new \Exception('Error al buscar usuarios por criterios');
        }
    }
}
