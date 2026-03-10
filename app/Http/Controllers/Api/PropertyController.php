<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Http\Resources\PropertyResource;

class PropertyController extends Controller
{
    // MÉTODO 1: Devuelve todas las propiedades (Para la página principal)
    public function index()
    {
        $properties = Property::orderBy('created_at', 'desc')->get();

        // Convertimos las rutas relativas en URLs completas para Next.js
        $properties->transform(function ($property) {
            // Si la imagen ya es un link de Unsplash (http...), la dejamos igual
            // Si no, le agregamos el http://localhost:8000/storage/
            if ($property->main_image_url && !str_starts_with($property->main_image_url, 'http')) {
                $property->main_image_url = asset('storage/' . $property->main_image_url);
            }
            return $property;
        });

        return response()->json(['data' => $properties]);
    }

    public function show($slug)
    {
        $property = Property::with('images')->where('slug', $slug)->first();

        if (!$property) {
            return response()->json(['message' => 'Propiedad no encontrada'], 404);
        }

        // Hacemos lo mismo para la vista de detalles
        if ($property->main_image_url && !str_starts_with($property->main_image_url, 'http')) {
            $property->main_image_url = asset('storage/' . $property->main_image_url);
        }

        return response()->json(['data' => $property]);
    }

   
}
