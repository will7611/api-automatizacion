<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Support\Str;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        $propiedades = [
            [
                'title' => 'Casa Colonial Restaurada en el Centro',
                'description' => 'Espectacular casa colonial a solo dos cuadras de la Plaza 25 de Mayo. Conserva sus patios de piedra originales, techos altos con vigas de madera y ha sido modernizada con instalaciones de primer nivel. Ideal para vivienda o proyecto boutique.',
                'price' => 250000.00,
                'bedrooms' => 5,
                'bathrooms' => 4,
                'parking_spaces' => 1,
                'square_meters' => 450,
                'status' => 'disponible',
                'amenities' => ["Patio central colonial", "Pileta de piedra", "Estudio", "Terraza con vista"],
                'main_image_url' => 'https://images.unsplash.com/photo-1512915922686-57c11dde9b6b?q=80&w=2000&auto=format&fit=crop',
                'gallery' => [
                    'https://images.unsplash.com/photo-1599423300746-b62533397364?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=1000&auto=format&fit=crop'
                ]
            ],
            [
                'title' => 'Departamento de Lujo frente al Parque Bolívar',
                'description' => 'Exclusivo departamento con vistas panorámicas al Parque Bolívar y la Corte Suprema. Diseño minimalista, amplios ventanales y luz natural todo el día. Cuenta con calefacción central.',
                'price' => 110000.00,
                'bedrooms' => 3,
                'bathrooms' => 3,
                'parking_spaces' => 1,
                'square_meters' => 140,
                'status' => 'disponible',
                'amenities' => ["Balcón panorámico", "Calefacción", "Ascensor privado", "Seguridad 24/7"],
                'main_image_url' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?q=80&w=2000&auto=format&fit=crop',
                'gallery' => [
                    'https://images.unsplash.com/photo-1502672260266-1c1de2d9d000?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1484154218962-a197022b5858?q=80&w=1000&auto=format&fit=crop'
                ]
            ],
            [
                'title' => 'Casa Familiar Moderna en Zona Aranjuez',
                'description' => 'Hermosa casa a estrenar en la exclusiva zona de Aranjuez, Sucre. Zona residencial muy tranquila y segura. Cuenta con un amplio jardín trasero, churrasquero y acabados de lujo.',
                'price' => 180000.00,
                'bedrooms' => 4,
                'bathrooms' => 4,
                'parking_spaces' => 2,
                'square_meters' => 300,
                'status' => 'disponible',
                'amenities' => ["Churrasquero equipado", "Jardín amplio", "Dependencias de servicio", "Despensa"],
                'main_image_url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?q=80&w=2000&auto=format&fit=crop',
                'gallery' => [
                    'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1600566752355-35792bedcfea?q=80&w=1000&auto=format&fit=crop'
                ]
            ],
            [
                'title' => 'Penthouse en Avenida Las Américas',
                'description' => 'El Penthouse más espectacular de Sucre. Situado en la Av. Las Américas, ofrece una vista 360 grados de la ciudad. Espacios abiertos, jacuzzi en la terraza y acabados en mármol.',
                'price' => 210000.00,
                'bedrooms' => 3,
                'bathrooms' => 4,
                'parking_spaces' => 2,
                'square_meters' => 220,
                'status' => 'preventa',
                'amenities' => ["Jacuzzi exterior", "Terraza 360", "Smart Home", "Gimnasio en edificio"],
                'main_image_url' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=2000&auto=format&fit=crop',
                'gallery' => [
                    'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1560185127-6ed189bf02f4?q=80&w=1000&auto=format&fit=crop'
                ]
            ],
            [
                'title' => 'Acogedora Casa de Campo en Yotala',
                'description' => 'A solo 20 minutos de Sucre, escapa del ruido en esta hermosa casa de campo en el valle de Yotala. Clima cálido todo el año, árboles frutales y piscina privada.',
                'price' => 95000.00,
                'bedrooms' => 3,
                'bathrooms' => 2,
                'parking_spaces' => 3,
                'square_meters' => 800,
                'status' => 'disponible',
                'amenities' => ["Piscina privada", "Árboles frutales", "Horno de barro", "Amplio terreno"],
                'main_image_url' => 'https://images.unsplash.com/photo-1588880331179-bc9b93a8cb65?q=80&w=2000&auto=format&fit=crop',
                'gallery' => [
                    'https://images.unsplash.com/photo-1524351199678-941a58a3df50?q=80&w=1000&auto=format&fit=crop'
                ]
            ],
            [
                'title' => 'Departamento Estudiantil cerca de la USFX',
                'description' => 'Inversión ideal. Departamento de un dormitorio a pasos de las principales facultades de la Universidad San Francisco Xavier. Alta demanda de alquiler.',
                'price' => 45000.00,
                'bedrooms' => 1,
                'bathrooms' => 1,
                'parking_spaces' => 0,
                'square_meters' => 55,
                'status' => 'vendido',
                'amenities' => ["Lavandería equipada", "Seguridad con tarjeta", "Zona WiFi"],
                'main_image_url' => 'https://images.unsplash.com/photo-1493809842364-78817add7ffb?q=80&w=2000&auto=format&fit=crop',
                'gallery' => [
                    'https://images.unsplash.com/photo-1502672023488-70e25813eb80?q=80&w=1000&auto=format&fit=crop'
                ]
            ],
            [
                'title' => 'Casa con Vista Panorámica en La Recoleta',
                'description' => 'Vive en el mirador de Sucre. Esta casa en la zona de La Recoleta ofrece los mejores atardeceres de la ciudad. Barrio turístico, seguro y muy tranquilo.',
                'price' => 165000.00,
                'bedrooms' => 4,
                'bathrooms' => 3,
                'parking_spaces' => 1,
                'square_meters' => 210,
                'status' => 'disponible',
                'amenities' => ["Mirador privado", "Diseño rústico-moderno", "Chimenea", "Patio interior"],
                'main_image_url' => 'https://images.unsplash.com/photo-1510798831971-661eb04b3739?q=80&w=2000&auto=format&fit=crop',
                'gallery' => [
                    'https://images.unsplash.com/photo-1513694203232-719a280e022f?q=80&w=1000&auto=format&fit=crop'
                ]
            ],
            [
                'title' => 'Duplex Elegante en Zona Garcilazo',
                'description' => 'Moderno departamento estilo Dúplex en Barrio Garcilazo. Excelente distribución, cocina americana y materiales de primera calidad. Condominio cerrado.',
                'price' => 85000.00,
                'bedrooms' => 3,
                'bathrooms' => 2,
                'parking_spaces' => 1,
                'square_meters' => 120,
                'status' => 'preventa',
                'amenities' => ["Cocina americana", "Condominio cerrado", "Áreas verdes"],
                'main_image_url' => 'https://images.unsplash.com/photo-1484154218962-a197022b5858?q=80&w=2000&auto=format&fit=crop',
                'gallery' => [
                    'https://images.unsplash.com/photo-1494526585095-c41746248156?q=80&w=1000&auto=format&fit=crop'
                ]
            ],
            [
                'title' => 'Casa Comercial en el Mercado Campesino',
                'description' => 'Propiedad con altísimo potencial comercial. Ubicada en una de las zonas de mayor movimiento económico de Sucre. Consta de 3 tiendas en planta baja y vivienda en la planta alta.',
                'price' => 320000.00,
                'bedrooms' => 5,
                'bathrooms' => 4,
                'parking_spaces' => 0,
                'square_meters' => 350,
                'status' => 'disponible',
                'amenities' => ["3 Tiendas comerciales", "Alto tráfico peatonal", "Vivienda independiente"],
                'main_image_url' => 'https://images.unsplash.com/photo-1582268611958-ebfd161ef9cf?q=80&w=2000&auto=format&fit=crop',
                'gallery' => [
                    'https://images.unsplash.com/photo-1556912173-3bb406ef7e77?q=80&w=1000&auto=format&fit=crop'
                ]
            ],
            [
                'title' => 'Departamento a Estrenar en Barrio Petrolero',
                'description' => 'Hermoso y soleado departamento en Barrio Petrolero. Zona residencial consolidada, cerca de colegios y supermercados. Entrega inmediata.',
                'price' => 78000.00,
                'bedrooms' => 2,
                'bathrooms' => 2,
                'parking_spaces' => 1,
                'square_meters' => 95,
                'status' => 'disponible',
                'amenities' => ["Ropero empotrado", "Lavandería", "Parqueo techado"],
                'main_image_url' => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?q=80&w=2000&auto=format&fit=crop',
                'gallery' => [
                    'https://images.unsplash.com/photo-1484154218962-a197022b5858?q=80&w=1000&auto=format&fit=crop'
                ]
            ]
        ];

        // Recorremos el arreglo para crear las propiedades y sus galerías de forma automática
        foreach ($propiedades as $data) {
            
            // 1. Creamos la Propiedad
            $property = Property::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'description' => $data['description'],
                'price' => $data['price'],
                'bedrooms' => $data['bedrooms'],
                'bathrooms' => $data['bathrooms'],
                'parking_spaces' => $data['parking_spaces'],
                'square_meters' => $data['square_meters'],
                'status' => $data['status'],
                'amenities' => $data['amenities'],
                'main_image_url' => $data['main_image_url'],
            ]);

            // 2. Insertamos la galería de imágenes para esta propiedad
            if (isset($data['gallery'])) {
                foreach ($data['gallery'] as $index => $imageUrl) {
                    PropertyImage::create([
                        'property_id' => $property->id,
                        'image_url' => $imageUrl,
                        'order' => $index + 1
                    ]);
                }
            }
        }
    }
}
