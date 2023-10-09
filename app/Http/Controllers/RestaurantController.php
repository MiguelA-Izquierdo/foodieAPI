<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $restaurants= Restaurant::all();
        return response()->json($restaurants);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Valida los datos enviados en la solicitud
            $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
            ]);

            // Crea un nuevo restaurante en la base de datos
            $restaurant = Restaurant::create([
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'phone' => $request->input('phone'),
            ]);

            return response()->json(['message' => 'Restaurante creado con éxito', 'Restaurant' => $restaurant], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se pudo crear el restaurante'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $restaurant = Restaurant::findOrFail($id); // Encuentra el restaurante por su ID

            return response()->json(['data' => $restaurant], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Restaurante no encontrado'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $restaurant = Restaurant::findOrFail($id); // Encuentra el restaurante por su ID

            // Valida los datos enviados en la solicitud
            $request->validate([
                'name' => 'string|max:255',
                'address' => 'string|max:255',
                'phone' => 'string|max:20',
            ]);

            // Actualiza los campos del restaurante si se proporcionan en la solicitud
            if ($request->has('name')) {
                $restaurant->name = $request->input('name');
            }

            if ($request->has('address')) {
                $restaurant->address = $request->input('address');
            }

            if ($request->has('phone')) {
                $restaurant->phone = $request->input('phone');
            }

            // Guarda los cambios
            $restaurant->save();

            return response()->json(['message' => 'Restaurante actualizado con éxito'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se pudo actualizar el restaurante'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)
    {
        try {
            $restaurant = Restaurant::findOrFail($id); // Encuentra el restaurante por su ID

            $restaurant->delete(); // Elimina el restaurante

            return response()->json(['message' => 'Restaurante eliminado con éxito'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se pudo eliminar el restaurante'], 500);
        }
    }
}
