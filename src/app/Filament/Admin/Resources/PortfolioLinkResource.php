<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PortfolioLinkResource\Pages;
use App\Models\PortfolioLink;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PortfolioLinkResource extends Resource
{
    protected static ?string $model = PortfolioLink::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';

    protected static ?string $navigationGroup = 'Portfolio Content';

    protected static ?string $navigationLabel = 'Links';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Link')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('group')
                        ->required()
                        ->default('footer')
                        ->helperText('Contoh: navigation, social, footer, contact.'),
                    Forms\Components\TextInput::make('label')->required()->maxLength(255),
                    Forms\Components\TextInput::make('url')->required()->maxLength(255),
                    Forms\Components\TextInput::make('icon')
                        ->maxLength(255)
                        ->helperText('Opsional. Bisa isi emoji atau nama ikon seperti github, instagram, mail.'),
                    Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                    Forms\Components\Toggle::make('is_enabled')->default(true),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->columns([
                Tables\Columns\TextColumn::make('label')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('group')->badge()->sortable(),
                Tables\Columns\TextColumn::make('url')->limit(40)->copyable(),
                Tables\Columns\IconColumn::make('is_enabled')->boolean(),
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('group')->options(fn () => PortfolioLink::query()->pluck('group', 'group')->toArray()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPortfolioLinks::route('/'),
            'create' => Pages\CreatePortfolioLink::route('/create'),
            'edit' => Pages\EditPortfolioLink::route('/{record}/edit'),
        ];
    }
}
