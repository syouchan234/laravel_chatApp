<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'accounts',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            //'provider' => 'users',
            'provider' => 'accounts',
        ],
        //'api' => [
        //    'driver' => 'token',
            'provider' => 'accounts'
        //]
    ],

    'providers' => [
        /* 書き換え前 */
        /*
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        */

        /* 書き換え後 */
        'accounts' => [
            'driver' => 'eloquent',
            'model' => App\Models\Account::class,
        ],
    ],

    'passwords' => [
//        'users' => [
        'accounts' => [
            //'provider' => 'users',
            'provider' => 'accounts',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
