<?php

return [
    'monnify' => [
        'url' => env('MONNIFY_URL', 'https://sandbox.monnify.com'),
        'api_key' => env('MONNIFY_API_KEY'),
        'secret' => env('MONNIFY_API_SECRET'),
        'contract_code' => env('MONNIFY_CONTRACT_CODE')
    ],
];