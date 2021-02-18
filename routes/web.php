<?php

use Illuminate\Support\Facades\Route;
use Braintree\Gateway as Gateway;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    
    $gateway = new Gateway([
                'environment' => 'sandbox',
                'merchantId' => 'xyg6km7tjcfh5hkh',
                'publicKey' => 'qghn6r3vsw6tqbbp',
                'privateKey' => '7b394a59ad46848440f8dc4171434f52'
            ]);
    $clientToken = $gateway->clientToken()->generate();
    return view('welcome', compact('clientToken'));
});