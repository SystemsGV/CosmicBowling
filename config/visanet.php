<?php

return [
  'development' => env('VISA_DEVELOPMENT', true),

  'merchant_id' => env('VISA_DEVELOPMENT') ? env('VISA_DEV_MERCHANT_ID') : env('VISA_PRD_MERCHANT_ID'),
  'user' => env('VISA_DEVELOPMENT') ? env('VISA_DEV_USER') : env('VISA_PRD_USER'),
  'password' => env('VISA_DEVELOPMENT') ? env('VISA_DEV_PWD') : env('VISA_PRD_PWD'),
  'url_security' => env('VISA_DEVELOPMENT') ? env('VISA_DEV_URL_SECURITY') : env('VISA_PRD_URL_SECURITY'),
  'url_session' => env('VISA_DEVELOPMENT') ? env('VISA_DEV_URL_SESSION') : env('VISA_PRD_URL_SESSION'),
  'url_js' => env('VISA_DEVELOPMENT') ? env('VISA_DEV_URL_JS') : env('VISA_PRD_URL_JS'),
  'url_authorization' => env('VISA_DEVELOPMENT') ? env('VISA_DEV_URL_AUTHORIZATION') : env('VISA_PRD_URL_AUTHORIZATION'),
];
