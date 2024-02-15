<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use Pusher\Pusher;

Route::get('/websocket', function () {
    $options = [
        'cluster' => env('PUSHER_APP_CLUSTER'),
        'useTLS' => true,
    ];

    $pusher = new Pusher(
        env('PUSHER_APP_KEY'),
        env('PUSHER_APP_SECRET'),
        env('PUSHER_APP_ID'),
        $options
    );

    $pusher->trigger(env('PUSHER_APP_NAME'), 'my-event', array( 'message' => 'hello world'));

    return view('websocket');
});