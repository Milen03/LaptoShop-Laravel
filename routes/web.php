<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LaptopController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('laptops', LaptopController::class);
});
