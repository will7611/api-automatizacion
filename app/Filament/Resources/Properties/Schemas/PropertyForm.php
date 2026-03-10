<?php

namespace App\Filament\Resources\Properties\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PropertyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('currency')
                    ->required()
                    ->default('USD'),
                TextInput::make('bedrooms')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('bathrooms')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('parking_spaces')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('square_meters')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('amenities'),
                 \Filament\Forms\Components\Select::make('status')
                    ->label('Estado')
                    ->options([
                        'disponible' => 'Disponible',
                        'preventa' => 'En Preventa',
                        'vendido' => 'Vendido',
                    ])
                    ->required()
                    ->default('disponible'),
                \Filament\Forms\Components\FileUpload::make('main_image_url')
                    ->label('Imagen Principal')
                    ->image()
                    ->disk('public') // Especifica el disco
                    ->directory('propiedades') // Guarda las fotos en storage/app/public/propiedades
                    ->imageEditor() // Opcional: permite recortar la imagen en el panel
                    ->required(),
            ]);
    }
}
