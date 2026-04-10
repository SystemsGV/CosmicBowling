<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Client;
use Illuminate\Http\Request;
use App\Models\Frontend\Client as FrontendClient;
use Illuminate\Support\Facades\Log;


class ClientController extends Controller
{
    public function index()
    {
        $data['title'] = "Cliente";
        return view('admin.client.index', $data);
    }

    public function show()
    {
        $clients = Client::getClients();
        return response()->json(['data' => $clients]);
    }

    public function search(Request $request)
    {


        $search = $request->search;
        $select = $request->select; // Asegúrate que esto sea 'number_doc' o el nombre de la columna en BD

        // Usamos el modelo Client y cargamos la relación 'partner' que acabamos de crear
        $client = FrontendClient::with('partner')->where($select, $search)->first();

        if (!$client) {
            return response()->json([
                'icon' => 'warning',
                'message' => 'No se encontró ningún usuario con esos datos.',
            ]);
        }

        // Si el cliente existe, pero no tiene un registro en la tabla client_socio
        if (!$client->partner) {
            return response()->json([
                'icon' => 'info',
                'message' => 'Se encontró al usuario ' . $client->names_client . ', pero no está registrado como socio.',
            ]);
        }

        // Si todo está bien, mandamos el objeto completo (incluyendo partner)
        return response()->json($client);
    }

    public function update(Request $request)
    {
        // 1. Formatear fecha (ojo al formato, si usas "/" en el front debe ser "d/m/Y")
        $birthday = null;
        if ($request->editbirthdate) {
            try {
                $birthday = \Carbon\Carbon::createFromFormat('d/m/Y', $request->editbirthdate)->format('Y-m-d');
            } catch (\Exception $e) {
                $birthday = null;
            }
        }

        // 2. Buscar al Cliente (Tabla Principal)
        $client = FrontendClient::find($request->editCodeHidden);

        if (!$client) {
            return response()->json(['icon' => 'error', 'message' => 'Cliente no encontrado']);
        }

        // 3. Actualizar datos del Cliente
        $client->lastname_pat   = $request->editpattername;
        $client->lastname_mat   = $request->editmattername;
        $client->names_client   = $request->editnames;
        $client->number_doc     = $request->editdoc;
        $client->birthday_client = $birthday;
        $client->address_client = $request->editaddress;
        $client->phone_client   = $request->editphone;
        $client->email_client   = $request->editmail;
        $client->save();

        // 4. Actualizar datos de Socio (donde vive el Apoderado)
        // Usamos la relación 'partner' que definiste en tu modelo Client
        if ($client->partner) {
            $socio = $client->partner;
            $socio->apod_nombre = $request->editproxyNames; // Viene de tu modal
            $socio->apod_doc    = $request->editproxyDoc;   // Viene de tu modal

            // También podrías actualizar la ficha de afiliación si es necesario
            $socio->affiliation = $request->editaffiliation;

            $socio->save();
        }

        return response()->json([
            'icon' => 'success',
            'message' => 'Se editaron los datos correctamente'
        ]);
    }



}
