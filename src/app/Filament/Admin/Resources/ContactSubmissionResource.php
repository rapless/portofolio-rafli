<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ContactSubmissionResource\Pages;
use App\Models\ContactSubmission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ContactSubmissionResource extends Resource
{
    protected static ?string $model = ContactSubmission::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';

    protected static ?string $navigationGroup = 'Portfolio Content';

    protected static ?string $navigationLabel = 'Contact Messages';

    protected static ?int $navigationSort = 5;

    public static function getNavigationBadge(): ?string
    {
        $count = ContactSubmission::query()->where('status', 'new')->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Visitor Message')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Visitor Name')
                        ->disabled()
                        ->dehydrated(false),
                    Forms\Components\TextInput::make('email')
                        ->label('Visitor Email')
                        ->disabled()
                        ->dehydrated(false),
                    Forms\Components\Textarea::make('message')
                        ->rows(8)
                        ->columnSpanFull()
                        ->disabled()
                        ->dehydrated(false),
                    Forms\Components\Select::make('status')
                        ->options([
                            'new' => 'New',
                            'read' => 'Read',
                            'replied' => 'Replied',
                            'archived' => 'Archived',
                        ])
                        ->required(),
                    Forms\Components\DateTimePicker::make('read_at')
                        ->disabled()
                        ->dehydrated(false),
                    Forms\Components\TextInput::make('ip_address')
                        ->disabled()
                        ->dehydrated(false),
                    Forms\Components\Textarea::make('user_agent')
                        ->rows(3)
                        ->columnSpanFull()
                        ->disabled()
                        ->dehydrated(false),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->searchable()->copyable(),
                Tables\Columns\TextColumn::make('message')->limit(70)->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'danger',
                        'read' => 'warning',
                        'replied' => 'success',
                        default => 'gray',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label('Received')->since()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options([
                    'new' => 'New',
                    'read' => 'Read',
                    'replied' => 'Replied',
                    'archived' => 'Archived',
                ]),
                Tables\Filters\Filter::make('unread')
                    ->query(fn (Builder $query): Builder => $query->where('status', 'new')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('mark_replied')
                    ->label('Mark Replied')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(fn (ContactSubmission $record) => $record->update(['status' => 'replied', 'read_at' => $record->read_at ?? now()])),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactSubmissions::route('/'),
            'view' => Pages\ViewContactSubmission::route('/{record}'),
        ];
    }
}
