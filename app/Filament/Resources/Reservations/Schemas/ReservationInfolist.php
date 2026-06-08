<?php

namespace App\Filament\Resources\Reservations\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ReservationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('product_id')
                    ->numeric(),
                TextEntry::make('buyer_id')
                    ->numeric(),
                TextEntry::make('seller_id')
                    ->numeric(),
                TextEntry::make('status'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('message')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('delivery_method')
                    ->placeholder('-'),
                TextEntry::make('delivery_address')
                    ->placeholder('-'),
                TextEntry::make('pickup_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('pickup_time')
                    ->time()
                    ->placeholder('-'),
                TextEntry::make('appointment_status')
                    ->placeholder('-'),
            ]);
    }
}
