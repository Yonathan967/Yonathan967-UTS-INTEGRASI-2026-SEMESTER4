<?php

return [
 
    'server_key'    => env('MIDTRANS_SERVER_KEY', ''),
    'client_key'    => env('MIDTRANS_CLIENT_KEY', ''),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'is_sanitized'  => true,
    'is_3ds'        => true,
    
    // Fix untuk ngrok
    'override_redirect_url' => env('APP_URL', 'https://blatancy-everyone-amuck.ngrok-free.dev'),
    'enable_payment' => true,
];