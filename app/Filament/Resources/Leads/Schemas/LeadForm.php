<?php

namespace App\Filament\Resources\Leads\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LeadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('preferred_schedule'),
                TextInput::make('source'),
                TextInput::make('property_id')
                    ->numeric(),
                TextInput::make('status')
                    ->required()
                    ->default('nuevo'),
                TextInput::make('assigned_to')
                    ->numeric(),
            ]);
    }
}
