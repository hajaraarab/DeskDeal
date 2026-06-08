<?php

namespace App\Filament\Resources\Reservations\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class ReservationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('product_id')
                    ->required()
                    ->numeric(),
                TextInput::make('buyer_id')
                    ->required()
                    ->numeric(),
                TextInput::make('seller_id')
                    ->required()
                    ->numeric(),
                TextInput::make('status')
                    ->required()
                    ->default('pending'),
                Textarea::make('message')
                    ->columnSpanFull(),
                TextInput::make('delivery_method'),
                TextInput::make('delivery_address'),
                DatePicker::make('pickup_date'),
                TimePicker::make('pickup_time'),
                TextInput::make('appointment_status'),
            ]);
    }
}
