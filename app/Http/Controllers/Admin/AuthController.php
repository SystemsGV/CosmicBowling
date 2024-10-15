<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('orders.validate');
        }

        return view('admin.login');
    }

    protected function credentials(Request $request)
    {
        return [
            'username' => $request->username,
            'password' => $request->password,
        ];
    }

    public function authenticate(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Intentar encontrar el usuario por el nombre de usuario
        $user = User::where('username', $request->username)->first();

        if ($user) {
            // Verificar la contraseña
            if (Hash::check($request->password, $user->password)) {
                // Iniciar sesión al usuario manualmente
                Auth::login($user);

                // Autenticación exitosa
                return response()->json([
                    'icon' => 'success',
                    'message' => 'Inicio de sesión exitoso',
                    'redirect_url' => route('orders.validate'), // Asegúrate de tener esta ruta definida
                ]);
            } else {
                // Contraseña incorrecta
                return response()->json([
                    'icon' => 'error',
                    'message' => 'Contraseña incorrecta',
                ]);
            }
        } else {
            // Nombre de usuario no encontrado
            return response()->json([
                'icon' => 'error',
                'message' => 'Nombre de usuario no encontrado',
            ]);
        }
    }
    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json('success');
    }
}
