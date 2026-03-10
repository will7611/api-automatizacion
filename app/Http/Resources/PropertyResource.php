<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titulo' => $this->title,
            'slug' => $this->slug,
            'precio' => number_format($this->price, 0), // Formateado para humanos
            'descripcion' => $this->description,
            'habitaciones' => $this->bedrooms,
            'banos' => $this->bathrooms,
            'parqueos' => $this->parking_spaces,
            'metros_cuadrados' => $this->square_meters,
            'amenidades' => $this->amenities,
            'estado' => $this->status,
            'imagen_principal' => $this->main_image_url,
            // Extraemos solo las URLs de las imágenes secundarias como un array simple para el SwiperJS
            'galeria_fotos' => $this->images->pluck('image_url')->toArray(), 
        ];
    }
}
