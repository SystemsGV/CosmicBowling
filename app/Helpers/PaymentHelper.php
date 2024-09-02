<?php

namespace App\Helpers;

class PaymentHelper
{
  public static function getErrorMessage($code)
  {
    $errors = config('payment_errors');

    return $errors[$code] ?? "Operación denegada. Por favor, inténtelo de nuevo más tarde.";
  }
}
