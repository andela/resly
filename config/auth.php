<?php

return [

    'multi-auth' => [
        'restaurateur' => [
            'driver' => 'eloquent',
            'model'  => Resly\Restaurateur::class
        ],
        'diner' => [
            'driver' => 'eloquent',
            'model'  => Resly\Diner::class
        ]
    ],
    /*
    |--------------------------------------------------------------------------
    | Password Reset Settings
    |--------------------------------------------------------------------------
    |
    | Here you may set the options for resetting passwords including the view
    | that is your password reset e-mail. You can also set the name of the
    | table that maintains all of the reset tokens for your application.
    |
    | The expire time is the number of minutes that the reset token should be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'password' => [
        'email' => 'emails.password',
        'table' => 'password_resets',
        'expire' => 60,
    ],

];
