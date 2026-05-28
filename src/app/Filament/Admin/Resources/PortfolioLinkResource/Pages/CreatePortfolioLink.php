<?php

namespace App\Filament\Admin\Resources\PortfolioLinkResource\Pages;

use App\Filament\Admin\Resources\PortfolioLinkResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePortfolioLink extends CreateRecord
{
    protected static string $resource = PortfolioLinkResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
