<?php

use App\Http\Controllers\Api\CEPController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    Route::get('/{cep}', [CEPController::class, 'show'])->name('cep');
});
