<?php

namespace App\Filament\Admin\Resources\PortfolioLinkResource\Pages;

use App\Filament\Admin\Resources\PortfolioLinkResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPortfolioLink extends EditRecord
{
    protected static string $resource = PortfolioLinkResource::class;

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
