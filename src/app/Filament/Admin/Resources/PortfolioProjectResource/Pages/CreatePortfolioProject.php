<?php

namespace App\Filament\Admin\Resources\PortfolioProjectResource\Pages;

use App\Filament\Admin\Resources\PortfolioProjectResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePortfolioProject extends CreateRecord
{
    protected static string $resource = PortfolioProjectResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
