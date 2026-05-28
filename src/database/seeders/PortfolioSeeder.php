<?php

namespace Database\Seeders;

use App\Models\PortfolioLink;
use App\Models\PortfolioProject;
use App\Models\PortfolioSection;
use App\Models\PortfolioSetting;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['group' => 'general', 'key' => 'site_name', 'label' => 'Site Name', 'type' => 'text', 'value' => ['value' => 'RYFDLLAH'], 'sort_order' => 1],
            ['group' => 'general', 'key' => 'page_title', 'label' => 'Browser Title', 'type' => 'text', 'value' => ['value' => 'Rafly Fadhillah — Portfolio'], 'sort_order' => 2],
            ['group' => 'general', 'key' => 'meta_description', 'label' => 'Meta Description', 'type' => 'textarea', 'value' => ['value' => 'Portfolio digital Rafly Fadhillah, mahasiswa Teknik Informatika dan web developer.'], 'sort_order' => 3],
            ['group' => 'contact', 'key' => 'contact_email', 'label' => 'Contact Email', 'type' => 'email', 'value' => ['value' => 'hello@example.com'], 'sort_order' => 1],
            ['group' => 'contact', 'key' => 'contact_whatsapp', 'label' => 'WhatsApp URL', 'type' => 'url', 'value' => ['value' => 'https://wa.me/6280000000000'], 'sort_order' => 2],
            ['group' => 'style', 'key' => 'accent_color', 'label' => 'Accent Color', 'type' => 'color', 'value' => ['value' => '#7c3aed'], 'sort_order' => 1],
        ];

        foreach ($settings as $setting) {
            PortfolioSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        $sections = [
            [
                'slug' => 'home',
                'title' => 'RAFLY FADHILLAH',
                'eyebrow' => 'Portofolio',
                'subtitle' => 'Saya menciptakan pengalaman digital yang memikat, melibatkan, dan menginspirasi melalui desain yang cermat dan solusi inovatif.',
                'button_label' => 'Lihat Project',
                'button_url' => '#portfolio',
                'items' => ['Laravel', 'Filament', 'UI/UX', 'Docker'],
                'sort_order' => 1,
            ],
            [
                'slug' => 'about',
                'title' => 'About Me',
                'eyebrow' => 'Kenalan dulu',
                'content' => '<p>Saya merupakan mahasiswa jurusan Teknik Informatika yang memiliki ketertarikan pada pengembangan aplikasi web dan teknologi perangkat lunak.</p><p>Saya terbiasa menggunakan PHP khususnya framework Laravel, serta memahami frontend seperti HTML, CSS, JavaScript, dan Blade template. Saya juga familiar dengan MySQL/MariaDB dan Docker.</p><p>Saya senang mempelajari teknologi baru, membangun proyek mandiri, dan terus mengembangkan kemampuan problem solving serta logika pemrograman.</p>',
                'items' => ['UI/UX Design', 'Web Development', 'Database', 'Laravel', 'Design Systems'],
                'sort_order' => 2,
            ],
            [
                'slug' => 'portfolio',
                'title' => 'Featured Work',
                'eyebrow' => 'Project pilihan',
                'subtitle' => 'Beberapa karya dan eksperimen yang bisa kamu kelola langsung dari admin panel.',
                'sort_order' => 3,
            ],
            [
                'slug' => 'contact',
                'title' => "Let's Work Together",
                'eyebrow' => 'Kontak',
                'subtitle' => "Punya ide, project, atau kolaborasi? Kirim pesan dan mari bikin sesuatu yang keren bareng.",
                'button_label' => 'Chat WhatsApp',
                'button_url' => 'https://wa.me/6280000000000',
                'sort_order' => 4,
            ],
        ];

        foreach ($sections as $section) {
            PortfolioSection::updateOrCreate(['slug' => $section['slug']], $section);
        }

        $projects = [
            [
                'title' => 'Presensi Mahasiswa',
                'description' => 'Website presensi berbasis QR Code dan geotagging untuk membantu proses absensi lebih cepat, rapi, dan terukur.',
                'technologies' => ['Laravel', 'Filament', 'MariaDB', 'QR Code'],
                'sort_order' => 1,
            ],
            [
                'title' => 'Digital Marketing Landing Page',
                'description' => 'Landing page modern dengan animasi interaktif, struktur SEO-friendly, dan fokus pada konversi.',
                'technologies' => ['Blade', 'CSS', 'JavaScript', 'SEO'],
                'sort_order' => 2,
            ],
            [
                'title' => 'Creative Portfolio CMS',
                'description' => 'Portfolio personal yang kontennya bisa dikelola lewat admin panel, mulai dari hero, about, project, hingga footer.',
                'technologies' => ['Laravel 12', 'Filament 3', 'Docker', 'MariaDB'],
                'sort_order' => 3,
            ],
        ];

        foreach ($projects as $project) {
            PortfolioProject::updateOrCreate(['title' => $project['title']], $project);
        }

        $links = [
            ['group' => 'navigation', 'label' => 'Home', 'url' => '#home', 'sort_order' => 1],
            ['group' => 'navigation', 'label' => 'About', 'url' => '#about', 'sort_order' => 2],
            ['group' => 'navigation', 'label' => 'Portfolio', 'url' => '#portfolio', 'sort_order' => 3],
            ['group' => 'navigation', 'label' => 'Contact', 'url' => '#contact', 'sort_order' => 4],
            ['group' => 'social', 'label' => 'GitHub', 'url' => 'https://github.com/', 'icon' => 'github', 'sort_order' => 1],
            ['group' => 'social', 'label' => 'Instagram', 'url' => 'https://instagram.com/', 'icon' => 'instagram', 'sort_order' => 2],
            ['group' => 'footer', 'label' => 'Privacy Policy', 'url' => '#privacy', 'sort_order' => 1],
            ['group' => 'footer', 'label' => 'Terms of Use', 'url' => '#terms', 'sort_order' => 2],
            ['group' => 'footer', 'label' => 'Sitemap', 'url' => '#sitemap', 'sort_order' => 3],
        ];

        foreach ($links as $link) {
            PortfolioLink::updateOrCreate([
                'group' => $link['group'],
                'label' => $link['label'],
            ], $link);
        }
    }
}
