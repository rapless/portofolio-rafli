<?php

namespace App\Filament\Admin\Resources\PortfolioProjectResource\Pages;

use App\Filament\Admin\Resources\PortfolioProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPortfolioProjects extends ListRecords
{
    protected static string $resource = PortfolioProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Project Baru'),
        ];
    }
}
