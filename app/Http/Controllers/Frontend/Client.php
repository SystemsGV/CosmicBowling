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
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\PersonalAccessToken;

class Client extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        // Crear y devolver el token
        $token = $client->createToken('ClientToken')->plainTextToken;

        Mail::to($client->email_client)->send(new VerifyClient($token));

        return response()->json(['token' => $token], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'number' => 'required|string',
            'password' => 'required|string',
        ]);

        $client = FrontendClient::where('number_doc', $request->input('number'))->first();

        if (!$client || !Hash::check($request->input('password'), $client->password_client)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }


        return response()->json(['token' => $client], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
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

            return response()->json(['message' => 'Cuenta verificada exitosamente. Ahora puedes iniciar sesión.']);
        }

        return response()->json(['message' => 'Token inválido o expirado.'], 400);
    }
    
}
