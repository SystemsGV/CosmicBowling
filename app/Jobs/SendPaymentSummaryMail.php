<?php

namespace App\Jobs;

use App\Mail\PaymentSummaryClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendPaymentSummaryMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        $email = $this->data['email'];

        try {
            Mail::to($email)->send(new PaymentSummaryClient($this->data));

            // Log para confirmar que se envió correctamente
            Log::info("Correo enviado correctamente a {$email}");
        } catch (\Exception $e) {
            // Log del error si falla el envío
            Log::error("Error al enviar correo a {$email}: " . $e->getMessage());

            // Si quieres reintentar luego, puedes lanzar la excepción
            throw $e;
        }
    }
}
