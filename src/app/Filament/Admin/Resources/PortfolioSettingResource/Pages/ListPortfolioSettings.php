<?php

namespace App\Filament\Admin\Resources\PortfolioSettingResource\Pages;

use App\Filament\Admin\Resources\PortfolioSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPortfolioSettings extends ListRecords
{
    protected static string $resource = PortfolioSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
