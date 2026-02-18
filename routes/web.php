<?php

use Illuminate\Support\Facades\Route;
// 1. IMPORTAMOS EL CONTROLADOR (El Gerente)
use App\Http\Controllers\ProductoController;

Route::get('/', function () {
    return view('welcome');
});

// 2. CREAMOS LA RUTA MÁGICA (El Mesero)
Route::resource('productos', ProductoController::class);