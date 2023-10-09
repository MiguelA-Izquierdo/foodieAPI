<?php

namespace App\Http\Controllers;

// use App\Providers\AuthServiceProvider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->getAll();
        return response()->json($users);
    }

    public function show($id)
    {
        try {
            $user = $this->userRepository->getById($id);
            return response()->json($user, 200);
        } catch (\Exception $error) {
            Log::error($error);
            return response()->json(['error' => 'Error al obtener el usuario por ID'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:users|max:255',
                'password' => 'required|string|min:8',
            ]);

            $this->userRepository->create($validatedData);
            return response()->json(['message' => 'Usuario creado con éxito'], 201);
        } catch (ValidationException $validationException) {
            return response()->json(['error' => $validationException->errors()], 400);
        } catch (\Exception $error) {
            Log::error($error);
            return response()->json(['error' => 'Error al crear el usuario'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = $this->userRepository->update($id, $request->all());
            return response()->json($user, 200);
        } catch (\Exception $error) {
            Log::error($error);
            return response()->json(['error' => 'Error al actualizar el usuario'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->userRepository->delete($id);
            return response()->json(['message' => 'Usuario eliminado con éxito'], 200);
        } catch (\Exception $error) {
            Log::error($error);
            return response()->json(['error' => 'Error al eliminar el usuario'], 500);
        }
    }
    
}
