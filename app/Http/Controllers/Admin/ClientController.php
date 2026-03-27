<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Client;
use Illuminate\Http\Request;
use App\Models\Frontend\Client as FrontendClient;

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

    
}
