<?php

return [
    'midrans' => [
        'serverKey' => env('MIDTRANS_SERVER_KEY', '#'),
        'isProduction' => env('MIDTRANS_ISPRODUCTION', false),
        'isSanitized' => env('MIDTRANS_CLIENT_KEY', '#'),
        'is3ds' => env('MIDTRANS_IS3DS', '#'),
    ],
];
