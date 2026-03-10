<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PropertyController;
use App\Http\Controllers\Api\LeadController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Ruta para obtener TODAS las propiedades (Usada en app/page.tsx)
Route::get('/propiedades', [PropertyController::class, 'index']);

// Ruta para obtener UNA propiedad específica (Usada en app/[slug]/page.tsx)
Route::get('/propiedades/{slug}', [PropertyController::class, 'show']);

// Esta es la ruta a la que apunta nuestro formulario en Next.js
Route::post('/leads', [LeadController::class, 'store']);