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

class EditContactSection extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationGroup = 'Portfolio Content';

    protected static ?string $navigationLabel = 'Contact Section';

    protected static ?string $title = 'Contact Section';

    protected static ?int $navigationSort = 4;

    protected static string $view = 'filament.admin.pages.edit-contact-section';

    public ?array $data = [];

    public function mount(): void
    {
        $section = PortfolioSection::firstOrCreate(
            ['slug' => 'contact'],
            [
                'title' => "Let's Work Together",
                'eyebrow' => 'Kontak',
                'subtitle' => 'Kirim nama, email, dan pesan kamu lewat form ini.',
                'button_label' => 'Kirim Pesan',
                'sort_order' => 4,
                'is_enabled' => true,
            ]
        );

        $this->form->fill([
            ...$section->only(['title', 'eyebrow', 'subtitle', 'content', 'button_label', 'is_enabled']),
            'contact_email' => PortfolioSetting::where('key', 'contact_email')->value('value->value'),
            'contact_whatsapp' => PortfolioSetting::where('key', 'contact_whatsapp')->value('value->value'),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Teks bagian contact')
                    ->description('Ubah teks yang muncul di samping form contact pada frontend.')
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
                            ->label('Deskripsi tambahan')
                            ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList', 'link', 'undo', 'redo'])
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('button_label')
                            ->label('Teks tombol submit')
                            ->maxLength(255),
                        Forms\Components\Toggle::make('is_enabled')
                            ->label('Tampilkan section contact')
                            ->default(true),
                    ]),
                Forms\Components\Section::make('Info kontak tambahan')
                    ->description('Opsional. Email/WhatsApp ini bisa ditampilkan di frontend.')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('contact_email')
                            ->label('Email kontak')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('contact_whatsapp')
                            ->label('WhatsApp URL')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://wa.me/628xxxx'),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $section = PortfolioSection::firstOrCreate(['slug' => 'contact']);
        $section->fill(collect($data)->only(['title', 'eyebrow', 'subtitle', 'content', 'button_label', 'is_enabled'])->all());
        $section->slug = 'contact';
        $section->button_url = '#contact';
        $section->sort_order = 4;
        $section->save();

        foreach (['contact_email' => 'Contact Email', 'contact_whatsapp' => 'WhatsApp URL'] as $key => $label) {
            PortfolioSetting::updateOrCreate(
                ['key' => $key],
                [
                    'group' => 'contact',
                    'label' => $label,
                    'type' => $key === 'contact_email' ? 'email' : 'url',
                    'value' => ['value' => $data[$key] ?? null],
                    'sort_order' => $key === 'contact_email' ? 1 : 2,
                    'is_public' => true,
                ]
            );
        }

        Notification::make()
            ->title('Contact section berhasil disimpan')
            ->success()
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('lihat_web')
                ->label('Lihat Website')
                ->url(route('home') . '#contact')
                ->openUrlInNewTab()
                ->icon('heroicon-o-arrow-top-right-on-square'),
        ];
    }
}
