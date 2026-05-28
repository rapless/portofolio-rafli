<?php

namespace App\Filament\Admin\Resources\PortfolioSettingResource\Pages;

use App\Filament\Admin\Resources\PortfolioSettingResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePortfolioSetting extends CreateRecord
{
    protected static string $resource = PortfolioSettingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
