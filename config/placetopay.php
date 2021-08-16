<?php

return [
    'login' => env('PLACETOPAY_LOGIN', 'DUMMY'),
    'tranKey' => env('PLACETOPAY_TRANSKEY', 'DUMMY'),
    'url_base' => env('PLACETOPAY_URL_BASE', 'DUMMY'),
    'timeout' => env('PLACETOPAY_TIMEOUT', 15),
    'connect_timeout' => env('PLACETOPAY_CONNECT_TIMEOUT', 5),
];
