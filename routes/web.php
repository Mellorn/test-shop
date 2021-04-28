<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web as Controllers;

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

Route::get('/', Controllers\HomeController::class)
    ->name('home');

Route::prefix('basket')
    ->name('basket.')
    ->group(function () {
        Route::post('add', [Controllers\BasketController::class, 'add'])
            ->name('add_item');

        Route::delete('remove/{id}', [Controllers\BasketController::class, 'remove'])
            ->name('remove_item');
    });

Route::prefix('checkout')
    ->name('checkout.')
    ->group(function () {
        Route::get('', [Controllers\CheckoutController::class, 'index'])
            ->name('index');

        Route::get('purchase', [Controllers\CheckoutController::class, 'purchase'])
            ->name('purchase');

        Route::post('purchase', [Controllers\CheckoutController::class, 'verifyPurchase'])
            ->name('verify_purchase');
    });
