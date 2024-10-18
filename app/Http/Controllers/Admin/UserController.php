<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $data['roles'] = Role::all();
        return view('admin.users.index', $data);
    }

    public function show()
    {
        $data = User::all();
        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'UserEmail' => 'required|email|unique:users,email',
            'UserName' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
        ]);
    
        // Si la validación falla, devolver los errores
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'icon' => 'error',
                'message' => 'Hay errores en el formulario.',
                'errors' => $validator->errors()
            ], 422);
        }
    
        // Si todo está bien, crear el usuario
        $user = new User();
        $user->name = $request->input('fullname');
        $user->email = $request->input('UserEmail');
        $user->username = $request->input('UserName');
        $user->password = Hash::make($request->input('password'));
    
        $user->save();
    
        return response()->json([
            'success' => true,
            'icon' => 'success',
            'message' => 'Usuario agregado'
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->input('id');
        $user->roles->sync($request->input('user-rol'));
    }
}
