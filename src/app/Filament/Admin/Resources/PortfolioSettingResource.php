<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PortfolioSettingResource\Pages;
use App\Models\PortfolioSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PortfolioSettingResource extends Resource
{
    protected static ?string $model = PortfolioSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Portfolio Content';

    protected static ?string $navigationLabel = 'Site Settings';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Setting')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('label')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('key')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255)
                        ->helperText('Contoh: site_name, primary_email, hero_title.'),
                    Forms\Components\TextInput::make('group')
                        ->required()
                        ->default('general')
                        ->maxLength(100),
                    Forms\Components\Select::make('type')
                        ->required()
                        ->default('text')
                        ->options([
                            'text' => 'Text',
                            'textarea' => 'Textarea',
                            'url' => 'URL',
                            'email' => 'Email',
                            'image' => 'Image path / URL',
                            'color' => 'Color',
                        ]),
                    Forms\Components\Textarea::make('value.value')
                        ->label('Value')
                        ->rows(5)
                        ->columnSpanFull()
                        ->helperText('Isi bebas. Untuk image boleh pakai URL penuh atau path storage, misalnya storage/hero/me.webp.'),
                    Forms\Components\TextInput::make('sort_order')
                        ->numeric()
                        ->default(0),
                    Forms\Components\Toggle::make('is_public')
                        ->label('Show on frontend')
                        ->default(true),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->columns([
                Tables\Columns\TextColumn::make('label')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('key')->searchable()->copyable(),
                Tables\Columns\TextColumn::make('group')->badge()->sortable(),
                Tables\Columns\TextColumn::make('type')->badge(),
                Tables\Columns\IconColumn::make('is_public')->boolean(),
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('group')->options(fn () => PortfolioSetting::query()->pluck('group', 'group')->toArray()),
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
            'index' => Pages\ListPortfolioSettings::route('/'),
            'create' => Pages\CreatePortfolioSetting::route('/create'),
            'edit' => Pages\EditPortfolioSetting::route('/{record}/edit'),
        ];
    }
}
