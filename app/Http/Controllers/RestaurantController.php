<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Repositories\RestaurantRepository;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    protected $restaurantRepository;

    public function __construct(RestaurantRepository $restaurantRepository)
    {
        $this->restaurantRepository = $restaurantRepository;
    }

    public function index()
    {
        try {
            $restaurants = $this->restaurantRepository->getAll();
            return response()->json($restaurants, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los restaurantes'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $newRestaurant = $request->only(['name', 'address', 'phone']);

            $restaurant = $this->restaurantRepository->create($newRestaurant);

            return response()->json(['message' => 'Restaurante creado con éxito', 'restaurant' => $restaurant], 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se pudo crear el restaurante'], 500);
        }
    }

    public function show($id)
    {
        try {
            $restaurant = $this->restaurantRepository->getById($id);
            return response()->json(['data' => $restaurant], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Restaurante no encontrado'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $restaurant = $this->restaurantRepository->getById($id);

            $validator = Validator::make($request->all(), [
                'name' => 'string|max:255',
                'address' => 'string|max:255',
                'phone' => 'string|max:20',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $newData = $request->only(['name', 'address', 'phone']);

            $this->restaurantRepository->update($id, $newData);

            return response()->json(['message' => 'Restaurante actualizado con éxito'], 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se pudo actualizar el restaurante'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->restaurantRepository->delete($id);
            return response()->json(['message' => 'Restaurante eliminado con éxito'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se pudo eliminar el restaurante'], 500);
        }
    }
}
