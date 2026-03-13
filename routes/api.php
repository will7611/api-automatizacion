<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PropertyController;
use App\Http\Controllers\Api\LeadController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// ─── Propiedades ─────────────────────────────────────────────────────
Route::get('/propiedades',        [PropertyController::class, 'index']);
Route::get('/propiedades/{slug}', [PropertyController::class, 'show']);

// ─── Leads ───────────────────────────────────────────────────────────
Route::post('/leads',             [LeadController::class, 'store']);

// ─── Endpoints para N8N / IA ─────────────────────────────────────────
Route::get('/n8n/contexto',       [LeadController::class, 'contextoIA']);   // ?telefono=591761...
Route::post('/n8n/cita',          [LeadController::class, 'agendarCita']);
