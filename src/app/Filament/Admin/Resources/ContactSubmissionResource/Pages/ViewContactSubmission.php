<?php

namespace App\Filament\Admin\Resources\ContactSubmissionResource\Pages;

use App\Filament\Admin\Resources\ContactSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewContactSubmission extends ViewRecord
{
    protected static string $resource = ContactSubmissionResource::class;

    public function mount(int | string $record): void
    {
        parent::mount($record);

        $this->record->markAsRead();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('mark_replied')
                ->label('Mark Replied')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->action(fn () => $this->record->update(['status' => 'replied', 'read_at' => $this->record->read_at ?? now()])),
            Actions\DeleteAction::make(),
        ];
    }
}
