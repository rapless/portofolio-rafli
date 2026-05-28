<?php

namespace App\Filament\Admin\Resources\PortfolioSettingResource\Pages;

use App\Filament\Admin\Resources\PortfolioSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPortfolioSetting extends EditRecord
{
    protected static string $resource = PortfolioSettingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
