<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PortfolioSectionResource\Pages;
use App\Models\PortfolioSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PortfolioSectionResource extends Resource
{
    protected static ?string $model = PortfolioSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Portfolio Content';

    protected static ?string $navigationLabel = 'Sections';

    protected static ?int $navigationSort = 2;

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }

    public static function canViewAny(): bool
    {
        return true;
    }

    public static function canCreate(): bool
    {
        return true;
    }

    public static function canEdit(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return true;
    }

    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return true;
    }

    public static function canDeleteAny(): bool
    {
        return true;
    }


    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Section Content')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->helperText('Gunakan slug penting: home, about, portfolio, contact.'),
                    Forms\Components\TextInput::make('title')->required()->maxLength(255),
                    Forms\Components\TextInput::make('eyebrow')->maxLength(255),
                    Forms\Components\Textarea::make('subtitle')->rows(3)->columnSpanFull(),
                    Forms\Components\RichEditor::make('content')
                        ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList', 'link', 'undo', 'redo'])
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('button_label')->maxLength(255),
                    Forms\Components\TextInput::make('button_url')->maxLength(255),
                    Forms\Components\FileUpload::make('image_path')
                        ->label('Image')
                        ->image()
                        ->directory('portfolio')
                        ->visibility('public')
                        ->imageEditor()
                        ->columnSpanFull(),
                    Forms\Components\TagsInput::make('items')
                        ->label('Items / Skills')
                        ->placeholder('Laravel')
                        ->columnSpanFull(),
                    Forms\Components\KeyValue::make('metadata')
                        ->label('Extra metadata')
                        ->keyLabel('Name')
                        ->valueLabel('Value')
                        ->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('slug')->badge()->searchable(),
                Tables\Columns\IconColumn::make('is_enabled')->boolean(),
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->since()->sortable(),
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
            'index' => Pages\ListPortfolioSections::route('/'),
            'create' => Pages\CreatePortfolioSection::route('/create'),
            'edit' => Pages\EditPortfolioSection::route('/{record}/edit'),
        ];
    }
}
