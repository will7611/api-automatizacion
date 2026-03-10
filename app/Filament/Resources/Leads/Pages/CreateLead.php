<?php

namespace App\Filament\Resources\Leads\Pages;

use App\Filament\Resources\Leads\LeadResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions; 

class CreateLead extends CreateRecord
{
    protected static string $resource = LeadResource::class;
     protected function getHeaderActions(): array
    {
        return [
            // ¡Esto es lo que dibuja el botón "Nueva Propiedad" arriba de la tabla!
            Actions\CreateAction::make()
                ->label('Nueva Propiedad'), 
        ];
    }
}
