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

    'github' => [
        'client_id'     => 'f4b203aa2f70ace471c1',
        'client_secret' => '31e8f28ec21a206308dd1cc7481e156b939af8f7',
        'redirect'      => 'http://localhost:8000/oauth/github/callback',
    ],

    'facebook' => [
        'client_id' => '169784447118967',
        'client_secret' => '209a4961e6e49cc5903b41e87e092f61',
        'redirect' => 'http://localhost:8000/oauth/facebook/callback'
    ],

    'google' => [
        'client_id' => '351125502264-s8j6hi9jn5nir50lsn4ei8aq432d11su.apps.googleusercontent.com',
        'client_secret' => 'HoR_CABcQJXf6XtULPzpW-9m',
        'redirect' => 'http://localhost:8000/oauth/google/callback'
    ],

];
