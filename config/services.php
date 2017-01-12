<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'vkontakte' => [
        'client_id' => env('VKONTAKTE_KEY'),
        'client_secret' => env('VKONTAKTE_SECRET'),
        'redirect' => env('VKONTAKTE_REDIRECT_URI'),
    ],

    'odnoklassniki' => [
        'client_id' => env('ODNOKLASSNIKI_ID'),
        'client_secret' => env('ODNOKLASSNIKI_SECRET'),
        'redirect' => env('ODNOKLASSNIKI_REDIRECT'),
    ],

    'mailru' => [
        'client_id' => env('MAILRU_ID'),
        'client_secret' => env('MAILRU_SECRET'),
        'redirect' => env('MAILRU_REDIRECT'),
    ],

    'facebook' => [
        'client_id' => '903990703036517',
        'client_secret' => '4797a2691dd2799baba4eafd73d86997',
        'redirect' => 'http://sint.odessa.ru/social/callback/facebook',
    ],

    'twitter' => [
        'client_id' => 'LZ9v30wr0ir0LrZ63eiZiIZta',
        'client_secret' => 'YsmOjZhS18xHhzFpQ0kpD3vv2j5oliS7a0GIgHGIjjMI5SXmdn',
        'redirect' => 'http://sint.odessa.ru/social_login/callback/twitter',
    ],

    'google' => [
        'client_id' => '412806846123-q200ls7tbfv34olsvdth72onh8akg3e6.apps.googleusercontent.com',
        'client_secret' => 'TllOUeLkLdNFFf-sELr1r3H9',
        'redirect' => 'http://sint.odessa.ru/social_login/callback/google',
    ],

];
