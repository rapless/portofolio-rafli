<?php

namespace App\Filament\Admin\Resources\PortfolioSectionResource\Pages;

use App\Filament\Admin\Resources\PortfolioSectionResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePortfolioSection extends CreateRecord
{
    protected static string $resource = PortfolioSectionResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
