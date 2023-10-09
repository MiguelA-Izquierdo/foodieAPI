<?php

namespace App\Repositories;

use App\Models\Restaurant;
use Illuminate\Support\Facades\Log;

class RestaurantRepository
{
    public function getAll()
    {
        try {
            return Restaurant::all();
        } catch (\Exception $error) {
            $this->logAndThrowException('Error al obtener todos los restaurantes', $error);
        }
    }

    public function getById($id)
    {
        try {
            $restaurant = Restaurant::find($id);
            if (!$restaurant) {
                $this->logAndThrowException('Restaurante no encontrado');
            }
            return $restaurant;
        } catch (\Exception $error) {
            $this->logAndThrowException('Error al obtener el restaurante por ID', $error);
        }
    }

    public function create($newData)
    {
        try {
            return Restaurant::create($newData);
        } catch (\Exception $error) {
            $this->logAndThrowException('Error al crear el restaurante', $error);
        }
    }

    public function update($id, $newData)
    {
        try {
            $restaurant = Restaurant::find($id);
            if (!$restaurant) {
                $this->logAndThrowException('Restaurante no encontrado');
            }

            $restaurant->update($newData);
            return $restaurant;
        } catch (\Exception $error) {
            $this->logAndThrowException('Error al actualizar el restaurante', $error);
        }
    }

    public function delete($id)
    {
        try {
            $restaurant = Restaurant::find($id);
            if (!$restaurant) {
                $this->logAndThrowException('Restaurante no encontrado');
            }

            $restaurant->delete();
        } catch (\Exception $error) {
            $this->logAndThrowException('Error al eliminar el restaurante', $error);
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
