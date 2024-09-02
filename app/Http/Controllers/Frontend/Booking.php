<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\PaymentHelper;
use App\Http\Controllers\Controller;
use App\Services\VisaNetService;
use Illuminate\Http\Request;

class Booking extends Controller
{
    protected $visanetService;

    public function __construct(VisaNetService $visanetService)
    {
        $this->visanetService = $visanetService;
    }
    public function summaryPayment(Request $request)
    {

        $summary = session('summary');

        $purchaseNumber = $summary['purchaseNumber'];
        $description = $summary['description'];
        $quantity = $summary['quantity'];
        $amount = $summary['amount'];

        $transaction = $request->input('transactionToken');

        $token =  $this->visanetService->generateToken();


        $data = $this->visanetService->generateAuthorization($amount, $purchaseNumber, $transaction, $token);

        $this->storeTransactionData($data);

        // Verifica si hay un error en los datos
        if (isset($data['errorCode'])) {
            $errorMessage = PaymentHelper::getErrorMessage($data['errorCode']);
            // Maneja el mensaje de error como prefieras
            return response()->json(['error' => $errorMessage], 400);
        }


        


        return view('frontend.cart.details', compact('token', 'transaction', 'purchaseNumber', 'description', 'quantity'));
    }

    /**
     * Almacena los datos de la transacción en un archivo JSON.
     *
     * @param array $data Datos de la transacción a guardar.
     */
    private function storeTransactionData(array $data)
    {
        // Define la ruta del archivo
        $filePath = storage_path('app/public/transaction_data.json');

        // Lee el contenido actual del archivo (si existe)
        if (file_exists($filePath)) {
            $existingData = json_decode(file_get_contents($filePath), true);
        } else {
            $existingData = [];
        }

        // Agrega los nuevos datos al array existente
        $existingData[] = $data;

        // Guarda el array actualizado en el archivo
        file_put_contents($filePath, json_encode($existingData, JSON_PRETTY_PRINT));
    }
}
