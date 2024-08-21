<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class VisaNetService
{
  protected $merchantId;
  protected $user;
  protected $password;
  protected $urlSecurity;
  protected $urlSession;
  protected $urlAuthorization;

  public function __construct()
  {
    $this->merchantId = config('visanet.merchant_id');
    $this->user = config('visanet.user');
    $this->password = config('visanet.password');
    $this->urlSecurity = config('visanet.url_security');
    $this->urlSession = config('visanet.url_session');
    $this->urlAuthorization = config('visanet.url_authorization');
  }

  public function generateToken()
  {
    $response = Http::withHeaders([
      'Authorization' => 'Basic ' . base64_encode($this->user . ":" . $this->password),
    ])->post($this->urlSecurity);

    return $response->body();
  }

  public function generateSession($amount, $token)
  {
    $session = [
      'amount' => $amount,
      'antifraud' => [
        'clientIp' => request()->ip(),
        'merchantDefineData' => [
          'MDD4' => "mail@domain.com",
          'MDD33' => "DNI",
          'MDD34' => '87654321'
        ],
      ],
      'channel' => 'web',
    ];

    $responseArray = $this->postRequest($this->urlSession, $session, $token);

    // Verifica si la clave 'sessionKey' existe y retorna su valor
    return isset($responseArray['sessionKey']) ? $responseArray['sessionKey'] : null;
  }
  public function generateAuthorization($amount, $purchaseNumber, $transactionToken, $token)
  {
    $data = [
      'antifraud' => null,
      'captureType' => 'manual',
      'channel' => 'web',
      'countable' => true,
      'order' => [
        'amount' => $amount,
        'currency' => 'PEN',
        'purchaseNumber' => $purchaseNumber,
        'tokenId' => $transactionToken
      ],
      'recurrence' => null,
      'sponsored' => null
    ];

    $response = $this->postRequest($this->urlAuthorization, $data, $token);
    return $response;
  }

  protected function postRequest($url, $postData, $token)
  {
    $response = Http::withHeaders([
      'Authorization' => $token,
      'Content-Type' => 'application/json',
    ])->post($url, $postData);

    // Decodifica la respuesta JSON en un array asociativo
    return $response->json(); // `json()` decodifica automáticamente la respuesta JSON
  }

  public function generatePurchaseNumber()
  {
    $filePath = storage_path('app/purchaseNumber.txt');
    $purchaseNumber = file_exists($filePath) ? (int)file_get_contents($filePath) : 222;
    $purchaseNumber++;
    file_put_contents($filePath, $purchaseNumber);

    return $purchaseNumber;
  }
}