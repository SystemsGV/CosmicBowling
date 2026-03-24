<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\RecoverClient;
use Illuminate\Http\Request;
use App\Models\Frontend\Client as FrontendClient;
use App\Models\Frontend\ClientSocio;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
//Mailing
use App\Mail\VerifyClient;
use App\Models\Admin\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\PersonalAccessToken;

class Client extends Controller
{


/*
    1. Si el cliente ya existe y quiere ser socio , se ignoran los datos del from y se usa los datos de client mediante la FK que es id cliente (excepto : email al que llega verificacion , telefono )
    2. Si no existe lo crea todo desde 0 y luego asocia mediante la FK , el correo de confirmacion de cuenta y de socio son lo mismo y se manda al mismo lugar
*/
  public function insertSocio(Request $request)
  {
    $dEmisDate = Carbon::createFromFormat('d-m-Y', $request->initdate)->format('Y-m-d');
    $dCaduDate = Carbon::createFromFormat('d-m-Y', $request->enddate)->format('Y-m-d');

    $client = FrontendClient::where('number_doc', $request->doc)->first();

    if ($client) {
        // CASO 1 — Ya existe en clients
        // ¿Ya es socio?
        $yaEsSocio = ClientSocio::where('client_id', $client->id_client)->first();
        if ($yaEsSocio) {
            return response()->json([
                'icon'    => 'warning',
                'message' => 'Este cliente ya está registrado como socio.'
            ], 422);
        }
        // NO se toca clients, solo se marca como socio
        $client->socio = 1;
        $client->save();

        // VERIFICACIÓN DE FECHA DE NACIMIENTO
        $birthdateForm = Carbon::parse($request->birthdate)->format('Y-m-d');
        $birthdateDB   = Carbon::parse($client->birthday_client)->format('Y-m-d');

            if ($birthdateForm !== $birthdateDB) {
            return response()->json([
                'icon'    => 'error',
                'message' => 'La fecha de nacimiento no coincide con la registrada.'
            ], 422);
        }

        // El email de confirmación viene del form (puede ser diferente al de clients)
        $confirmationEmail = $request->mail ?? $client->email_client;
        $tipoCaso          = 'socio'; // CASO B


    } else {
        // CASO 2 — No existe, crea todo desde 0
        $client = FrontendClient::create([
            'document_id'     => '01',                          // DNI por defecto
            'lastname_pat'    => $request->pattername,
            'lastname_mat'    => $request->mattername,
            'names_client'    => $request->names,
            'number_doc'      => $request->doc,                // Esto va a ser su usuario y contraseña en caso se este creando ambos por pimera ves
            'email_client'    => $request->mail,
            'phone_client'    => $request->phone,
            'address_client'  => $request->address,                 // DNI como dirección
            'birthday_client' => Carbon::parse($request->birthdate)->format('Y-m-d'),

            'password_client' => Hash::make($request->doc),     // DNI como password -> la contraseña si ess la misma al DNI
            'socio'           => 1,
            'validacion'      => 0,
        ]);

        // El email de confirmación es el mismo que se registró
        $confirmationEmail = $request->mail;
        $tipoCaso          = 'nuevo_socio'; // CASO C
    }

    // PASO 2 — Apoderado (ambos casos)
    $apodNombre = null;
    $apodDoc    = null;

    if (!empty($request->proxyPatter) || !empty($request->proxyNames)) {
        $apodNombre = trim(
            $request->proxyPatter . ' ' .
            $request->proxyMatter . ' ' .
            $request->proxyNames
        );
        $apodDoc = $request->proxyDoc;
    }

    $phone_number = $request->phone;
    // mismo cumpleaños

    // PASO 3 — Crea client_socio (ambos casos) $request->phone,
    try {
        ClientSocio::create([
            'client_id'          => $client->id_client,
            'nTarjNumb'          => str_pad($client->id_client, 8, '0', STR_PAD_LEFT),
            'cTarjActi'          => 1,
            'dEmisDate'          => $dEmisDate,
            'dCaduDate'          => $dCaduDate,
            'affiliation'        => $request->affiliation,
            'validado'           => 0,
            'status_magic'       => 0,
            'confirmation_email' => $confirmationEmail,
            'apod_nombre'        => $apodNombre,
            'apod_doc'           => $apodDoc,
            'user_new'           => auth()->user()->name ?? 'ATC',

            'phone_number'       => $phone_number,
        ]);

        // Genera token con nombre según el caso
        $token = $client->createToken($tipoCaso)->plainTextToken;

        Log::info("Enviando correo de confirmación...", [
            'destino' => $confirmationEmail,
            'caso'    => $tipoCaso,
            'token'   => $token
        ]);

        // Manda el email
        Mail::to($confirmationEmail)->send(
            new VerifyClient($token, $client->names_client, $tipoCaso)
        );

        Log::info("Correo enviado exitosamente a: " . $confirmationEmail);

        return response()->json([
            'icon'    => 'success',
            'message' => 'Socio registrado correctamente.'
        ]);

        } catch (\Throwable $th) {
            return response()->json([
                'icon'    => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }

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
        $title = "Perfil";
        $client = Auth::guard('client')->user();

        $reservations = Cart::getReservationsByClient($client->id_client);

        return view('frontend.client.profile', compact('client', 'reservations', 'title'));
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
             'document_id'     => $request->type_doc ?? '00',
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

        // Cargar la relación con SunatTypeDoc
        $client = FrontendClient::with('sunatTypedoc')->where('number_doc', $request->input('number'))->first();

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

        // Autenticar al cliente
        Auth::guard('client')->login($client);

        // Generar token de autenticación
        $token = $client->createToken('ClientToken')->plainTextToken;

        // Obtener el primer nombre y la URL del avatar
        $firstName = explode(' ', trim($client->names_client))[0];
        $avatarUrl = asset('frontend/img/avatar/51.jpg');

        // Obtener el documento relacionado con SunatTypeDoc
        $sunatDoc = $client->sunatTypedoc ? $client->sunatTypedoc->id_doc : null;

        return response()->json([
            'token' => $token,
            'user' => [
                'name' => $firstName,
                'avatar' => $avatarUrl,
                'names' => $client->names_client,
                'pattername' => $client->lastname_pat,
                'mattername' => $client->lastname_mat,
                'email' => $client->email_client,
                'phone' => $client->phone_client,
                'document' => $client->number_doc,
                'sunatdoc' => $sunatDoc  // Incluyendo el dato adicional
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
    }



    public function verifyEmail(Request $request)
    {
    $tokenString = $request->input('token');

    // 1. Buscamos el MODELO del token primero
    $accessToken = \Laravel\Sanctum\PersonalAccessToken::findToken($tokenString);

    if (!$accessToken) {
        return view('verification-error')->with('error', 'El link es inválido o ya fue usado.');
    }

    // 2. Ahora sí, sacamos el cliente y el nombre del caso
    $client = $accessToken->tokenable;
    $tipoCaso = $accessToken->name;

    if ($client) {
        // --- LOGICA DE CLIENTE ---
        if ($tipoCaso === 'nuevo_socio') {
            $client->email_verified_at = now();
            $client->socio = 1;
            $client->validacion = 1;
        } else {
            $client->socio = 1;
            $client->validacion = 1;
        }

        $client->save(); // ¡IMPORTANTE! Si no, no se guarda nada.

        // --- LOGICA DE LA TABLA SOCIO ---
        // Buscamos su registro en la otra tabla para validarlo ahí también
        $socioData = ClientSocio::where('client_id', $client->id_client)
                                            ->where('validado', 0)
                                            ->first();
        if ($socioData) {
            $socioData->validado = 1;
            $socioData->save();
        }

        $accessToken->delete();

        return view('frontend.login.verify')->with('status', '¡Verificación exitosa! Ya eres socio.');
    }

    return view('verification-error')->with('error', 'No se pudo encontrar al usuario.');
    }

    public function recover(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $client = FrontendClient::where('email_client', $request->input('email'))->first();

        if (!$client) {
            return response()->json(['error' => 'Correo electrónico incorrecto'], 401);
        }

        $token = $client->createToken('ClientToken')->plainTextToken;

        Mail::to($client->email_client)->send(new RecoverClient($token, $client->name_client));

        return response()->json(['message' => 'Correo de recuperación enviado'], 200);
    }

    public function recoverPassword(Request $request)
    {
        $token = $request->input('token');

        $client = PersonalAccessToken::findToken($token)->tokenable;

        //view interface two textbox recover password

        if ($client) {
            return view('frontend.login.recover-password', compact('token'));
        }

        return view('frontend.login.recover');
    }

    public function reset(Request $request)
    {

        $client = PersonalAccessToken::findToken($request->input('token'))->tokenable;

        if ($client) {
            $client->password_client = Hash::make($request->input('password'));
            $client->save();

            return response()->json(['message' => 'Contraseña restablecida'], 200);
        }

        return response()->json(['error' => 'Token inválido'], 401);
    }


}
