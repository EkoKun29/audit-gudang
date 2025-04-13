<?php

namespace App\Filament\Resources\AuditCheckersResource\Pages;

use App\Filament\Resources\AuditCheckersResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAuditCheckers extends ListRecords
{
    protected static string $resource = AuditCheckersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
