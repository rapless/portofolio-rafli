<?php

namespace App\Filament\Admin\Pages;

use App\Models\PortfolioSection;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class EditAboutMe extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static ?string $navigationGroup = 'Portfolio Content';

    protected static ?string $navigationLabel = 'About Me';

    protected static ?string $title = 'About Me';

    protected static ?int $navigationSort = 2;

    protected static string $view = 'filament.admin.pages.edit-about-me';

    public ?array $data = [];

    public function mount(): void
    {
        $section = PortfolioSection::firstOrCreate(
            ['slug' => 'about'],
            [
                'title' => 'About Me',
                'eyebrow' => 'Kenalan dulu',
                'content' => '<p>Tulis cerita tentang dirimu di sini.</p>',
                'sort_order' => 2,
                'is_enabled' => true,
            ]
        );

        $this->form->fill($section->only([
            'title',
            'eyebrow',
            'subtitle',
            'content',
            'image_path',
            'items',
            'is_enabled',
        ]));
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Konten About Me')
                    ->description('Ubah seluruh bagian About Me di frontend: judul, paragraf, gambar, dan daftar skill.')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('eyebrow')
                            ->label('Label kecil')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('subtitle')
                            ->label('Deskripsi pendek')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('content')
                            ->label('Isi About Me')
                            ->toolbarButtons(['bold', 'italic', 'underline', 'bulletList', 'orderedList', 'link', 'blockquote', 'undo', 'redo'])
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('image_path')
                            ->label('Gambar / foto about')
                            ->image()
                            ->directory('portfolio/about')
                            ->visibility('public')
                            ->imageEditor()
                            ->columnSpanFull(),
                        Forms\Components\TagsInput::make('items')
                            ->label('Skill / topik')
                            ->placeholder('Laravel')
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('is_enabled')
                            ->label('Tampilkan section about')
                            ->default(true),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $section = PortfolioSection::firstOrCreate(['slug' => 'about']);
        $section->fill($data);
        $section->slug = 'about';
        $section->sort_order = 2;
        $section->save();

        Notification::make()
            ->title('About Me berhasil disimpan')
            ->success()
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('lihat_web')
                ->label('Lihat Website')
                ->url(route('home') . '#about')
                ->openUrlInNewTab()
                ->icon('heroicon-o-arrow-top-right-on-square'),
        ];
    }
}
