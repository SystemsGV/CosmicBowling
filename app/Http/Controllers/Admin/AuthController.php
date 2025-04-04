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
            $role = Auth::user()->username;
    
            if ($role === 'CONTADOR') {
                return redirect()->route('orders.index'); 
            } else {
                return redirect()->route('orders.validate'); 
            }
        }
    
        return view('admin.login'); // Vista de login si no está autenticado
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
    
                // Redireccionar según el rol del usuario
                $redirectUrl = $request->username === 'CONTADOR' 
                    ? route('orders.index') // Ruta para el rol "contador" (Reservas)
                    : route('orders.validate'); // Ruta por defecto para otros roles (Validar Reserva)
    
                // Autenticación exitosa
                return response()->json([
                    'icon' => 'success',
                    'message' => 'Inicio de sesión exitoso',
                    'redirect_url' => $redirectUrl,
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
