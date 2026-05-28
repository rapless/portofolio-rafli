<?php

namespace App\Filament\Admin\Pages;

use App\Models\PortfolioSection;
use App\Models\PortfolioSetting;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class EditHomeProfile extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationGroup = 'Portfolio Content';

    protected static ?string $navigationLabel = 'Home Profile';

    protected static ?string $title = 'Home Profile';

    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.admin.pages.edit-home-profile';

    public ?array $data = [];

    public function mount(): void
    {
        $section = PortfolioSection::firstOrCreate(
            ['slug' => 'home'],
            [
                'title' => 'RAFLY FADHILLAH',
                'eyebrow' => 'Portofolio',
                'subtitle' => 'Website portfolio dinamis berbasis Laravel dan Filament.',
                'button_label' => 'Lihat Project',
                'button_url' => '#portfolio',
                'sort_order' => 1,
                'is_enabled' => true,
            ]
        );

        $this->form->fill($section->only([
            'title',
            'eyebrow',
            'subtitle',
            'button_label',
            'button_url',
            'image_path',
            'items',
            'metadata',
            'is_enabled',
        ]));
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Identitas utama di hero')
                    ->description('Bagian ini mengubah nama, deskripsi singkat, foto profil, tombol, dan card profil di halaman paling atas portfolio.')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Nama / Judul besar')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Contoh: RAFLY FADHILLAH'),
                        Forms\Components\TextInput::make('eyebrow')
                            ->label('Label kecil di atas nama')
                            ->maxLength(255)
                            ->helperText('Contoh: Portofolio'),
                        Forms\Components\Textarea::make('subtitle')
                            ->label('Deskripsi singkat')
                            ->rows(4)
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('image_path')
                            ->label('Foto profile')
                            ->image()
                            ->directory('portfolio/profile')
                            ->visibility('public')
                            ->imageEditor()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('button_label')
                            ->label('Teks tombol utama')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('button_url')
                            ->label('Link tombol utama')
                            ->maxLength(255)
                            ->helperText('Bisa pakai #portfolio, #contact, atau URL lengkap.'),
                        Forms\Components\TagsInput::make('items')
                            ->label('Skill / highlight kecil')
                            ->placeholder('Laravel')
                            ->columnSpanFull(),
                        Forms\Components\KeyValue::make('metadata')
                            ->label('Deskripsi card profile')
                            ->keyLabel('Field')
                            ->valueLabel('Isi')
                            ->helperText('Gunakan field: profile_kicker, profile_headline, profile_description.')
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('is_enabled')
                            ->label('Tampilkan section home')
                            ->default(true),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $section = PortfolioSection::firstOrCreate(['slug' => 'home']);
        $section->fill($data);
        $section->slug = 'home';
        $section->sort_order = 1;
        $section->save();

        PortfolioSetting::updateOrCreate(
            ['key' => 'site_name'],
            [
                'group' => 'general',
                'label' => 'Site Name',
                'type' => 'text',
                'value' => ['value' => $data['title'] ?? 'Portfolio'],
                'sort_order' => 1,
                'is_public' => true,
            ]
        );

        Notification::make()
            ->title('Home profile berhasil disimpan')
            ->success()
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('lihat_web')
                ->label('Lihat Website')
                ->url(route('home'))
                ->openUrlInNewTab()
                ->icon('heroicon-o-arrow-top-right-on-square'),
        ];
    }
}
