<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/test-mail', function () {

    Mail::raw(
        'Mail Working',
        function ($message) {

            $message->to('your@email.com')
                    ->subject('Test');
        }
    );

    return 'sent';
});
