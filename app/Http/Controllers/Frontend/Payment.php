<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\VisanetService;
use Illuminate\Support\Facades\Auth;

class Payment extends Controller
{
    protected $visanetService;

    public function __construct(VisanetService $visanetService)
    {
        $this->visanetService = $visanetService;
    }

    public function showPaymentForm()
    {

    }

    public function finalizePayment(Request $request)
    {
        // Aquí manejarías la lógica para finalizar el pago y procesar el resultado
        return view('payment.finalize');
    }
}