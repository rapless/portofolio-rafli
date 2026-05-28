<?php

namespace App\Filament\Admin\Resources\PortfolioSectionResource\Pages;

use App\Filament\Admin\Resources\PortfolioSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPortfolioSections extends ListRecords
{
    protected static string $resource = PortfolioSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
