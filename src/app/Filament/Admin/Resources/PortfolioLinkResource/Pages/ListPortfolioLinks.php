<?php

namespace App\Filament\Admin\Resources\PortfolioLinkResource\Pages;

use App\Filament\Admin\Resources\PortfolioLinkResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPortfolioLinks extends ListRecords
{
    protected static string $resource = PortfolioLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
