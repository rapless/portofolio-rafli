<?php

namespace App\Filament\Admin\Resources\PortfolioSectionResource\Pages;

use App\Filament\Admin\Resources\PortfolioSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPortfolioSection extends EditRecord
{
    protected static string $resource = PortfolioSectionResource::class;

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
