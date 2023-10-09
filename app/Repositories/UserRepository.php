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
            $this->logAndThrowException('Error al obtener todos los usuarios', $error);
        }
    }

    public function getById($id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                $this->logAndThrowException('Usuario no encontrado');
            }
            return $user;
        } catch (\Exception $error) {
            $this->logAndThrowException('Error al obtener el usuario por ID', $error);
        }
    }

    public function create($newData)
    {
        try {
            return User::create($newData);
        } catch (\Exception $error) {
            $this->logAndThrowException('Error al crear el usuario', $error);
        }
    }

    public function update($id, $newData)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                $this->logAndThrowException('Usuario no encontrado');
            }

            $user->update($newData);
            return $user;
        } catch (\Exception $error) {
            $this->logAndThrowException('Error al actualizar el usuario', $error);
        }
    }

    public function delete($id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                $this->logAndThrowException('Usuario no encontrado');
            }

            $user->delete();
        } catch (\Exception $error) {
            $this->logAndThrowException('Error al eliminar el usuario', $error);
        }
    }

    public function find(array $criteria)
    {
        try {
            return User::where($criteria)->get();
        } catch (\Exception $error) {
            $this->logAndThrowException('Error al buscar usuarios por criterios', $error);
        }
    }

    private function logAndThrowException($message, \Exception $error = null)
    {
        if ($error) {
            Log::error($error);
        }
        throw new \Exception($message);
    }
}
