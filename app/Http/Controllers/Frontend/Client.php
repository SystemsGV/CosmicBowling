<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\Client as FrontendClient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


//Mailing
use App\Mail\VerifyClient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\PersonalAccessToken;

class Client extends Controller
{

    public function __construct()
    {
        $this->middleware('client.auth')->only(['show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->guard('client')->check()) {
            return redirect()->route('home.index');
        }

        return view('frontend.login.index');
    }

    public function show()
    {
        $client = Auth::guard('client')->user();
        return view('frontend.client.profile', compact('client'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->guard('client')->check()) {
            return redirect()->route('home.index');
        }
        return view('frontend.login.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type_doc' => 'required',
            'number_doc' => 'required|unique:clients,number_doc',
            'paternal' => 'required',
            'maternal' => 'required',
            'firstname' => 'required',
            'mail_user' => 'required|email|unique:clients,email_client',
            'phone_user' => 'required',
            'birthday_user' => 'required|date_format:d/m/Y',
            'district_user' => 'required',
            'current_password' => 'required|min:8',
        ], [
            'number_doc.unique' => 'El número de documento ya está registrado. Por favor, use otro número.',
            'mail_user.unique' => 'El correo electrónico ya está en uso. Por favor, use otro correo.',
            'current_password.min' => 'La contraseña debe tener al menos :min caracteres.',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $birthday = Carbon::createFromFormat('d/m/Y', $request->input('birthday_user'))->format('Y-m-d');

        $client = FrontendClient::create([
            'document_id' => $request->input('type_doc'),
            'number_doc' => $request->input('number_doc'),
            'lastname_pat' => $request->input('paternal'),
            'lastname_mat' => $request->input('maternal'),
            'names_client' => $request->input('firstname'),
            'email_client' => $request->input('mail_user'),
            'phone_client' => $request->input('phone_user'),
            'birthday_client' => $birthday,
            'address_client' => $request->input('district_user'),
            'password_client' => Hash::make($request->input('current_password'))
        ]);

        $token = $client->createToken('ClientToken')->plainTextToken;

        Mail::to($client->email_client)->send(new VerifyClient($token, $client->name_client));

        return response()->json(['token' => $token], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'number' => 'required|string',
            'password' => 'required|string',
        ]);

        $client = FrontendClient::where('number_doc', $request->input('number'))->first();

        if (!$client) {
            return response()->json(['error' => 'Número de documento incorrecto'], 401);
        }

        if (!Hash::check($request->input('password'), $client->password_client)) {
            return response()->json(['error' => 'Contraseña incorrecta'], 401);
        }

        // Verificar si la cuenta está verificada
        if (!$client->email_verified_at) {
            // Enviar correo de verificación
            $token = $client->createToken('ClientToken')->plainTextToken;
            Mail::to($client->email_client)->send(new VerifyClient($token, $client->name_client));

            return response()->json([
                'error' => 'Cuenta no verificada',
                'message' => 'Por favor, verifique su correo electrónico para activar su cuenta. Hemos enviado un nuevo correo de verificación.'
            ], 403);
        }

        Auth::guard('client')->login($client);

        $token = $client->createToken('ClientToken')->plainTextToken;

        $firstName = explode(' ', trim($client->names_client))[0];
        $avatarUrl = asset('frontend/img/avatar/51.jpg');

        return response()->json([
            'token' => $token,
            'user' => [
                'name' => $firstName,
                'avatar' => $avatarUrl,
                'names' => $client->names_client,
                'pattername' => $client->lastname_pat,
                'mattername' => $client->lastname_mat,
                'email' => $client->email_client,
                'phone' => $client->phone_client
            ]
        ], 200);
    }

    public function logout(Request $request)
    {
        // Elimina los tokens si estás usando tokens para autenticación
        if ($request->user()) {
            $request->user()->tokens()->delete();
        }

        // Cierra la sesión
        Auth::guard('client')->logout();

        // Invalidar la sesión
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Successfully logged out'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function verifyEmail(Request $request)
    {
        $token = $request->input('token');

        // Encuentra el cliente asociado con el token
        $client = PersonalAccessToken::findToken($token)->tokenable;

        if ($client) {
            // Marca al cliente como verificado
            $client->email_verified_at = now();
            $client->save();

            // Retorna la vista con un mensaje de éxito
            return view('frontend.login.verify')->with('status', 'Cuenta verificada exitosamente. Ahora puedes iniciar sesión.');
        }

        // Retorna la vista con un mensaje de error
        return view('verification-error')->with('error', 'Token inválido o expirado.');
    }
}
