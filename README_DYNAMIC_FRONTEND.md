# Dynamic Portfolio Update

Frontend portfolio sekarang sudah tidak hardcode. Konten utama diambil dari database dan bisa diubah lewat Filament admin panel.

## Menu admin baru

Masuk ke `/admin`, lalu cek grup **Portfolio Content**:

- **Site Settings**: nama website, title browser, meta description, email, warna accent, dan setting global lain.
- **Sections**: konten section `home`, `about`, `portfolio`, dan `contact`.
- **Projects**: kartu project di section portfolio.
- **Links**: link navigasi, social media, contact, dan footer.

## File penting yang berubah / ditambah

- `src/routes/web.php`
- `src/app/Http/Controllers/HomeController.php`
- `src/resources/views/welcome.blade.php`
- `src/public/front/portfolio-modern.css`
- `src/public/front/portfolio-modern.js`
- `src/app/Models/PortfolioSetting.php`
- `src/app/Models/PortfolioSection.php`
- `src/app/Models/PortfolioProject.php`
- `src/app/Models/PortfolioLink.php`
- `src/app/Filament/Admin/Resources/PortfolioSettingResource.php`
- `src/app/Filament/Admin/Resources/PortfolioSectionResource.php`
- `src/app/Filament/Admin/Resources/PortfolioProjectResource.php`
- `src/app/Filament/Admin/Resources/PortfolioLinkResource.php`
- `src/database/migrations/2026_05_28_000000_create_portfolio_settings_table.php`
- `src/database/migrations/2026_05_28_000001_create_portfolio_sections_table.php`
- `src/database/migrations/2026_05_28_000002_create_portfolio_projects_table.php`
- `src/database/migrations/2026_05_28_000003_create_portfolio_links_table.php`
- `src/database/seeders/PortfolioSeeder.php`

## Cara jalanin

Kalau pakai Docker project ini seperti sebelumnya:

```bash
docker compose up -d --build
```

Entry point project ini sudah menjalankan migration, seed, dan `storage:link`.

Kalau manual dari folder `src`:

```bash
composer install
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

## Catatan

Upload gambar dari admin disimpan ke disk public Laravel. Pastikan `php artisan storage:link` sudah jalan supaya gambar muncul di frontend.

## Update CMS Portfolio + Contact Form

Versi ini menambahkan alur yang kamu minta:

- Nama, headline, deskripsi hero, foto profile, dan highlight profile bisa diedit dari **Portfolio Content > Sections > home**.
- Bagian **About Me** bisa diedit penuh dari **Portfolio Content > Sections > about**, termasuk foto, rich text, dan skill/tag.
- Bagian **Featured Work** bisa ditambah, edit, hide/show, atau hapus lewat **Portfolio Content > Projects**.
- Bagian **Contact** sekarang memakai form visitor: nama, email, dan pesan.
- Semua pesan visitor tersimpan di database dan bisa dibaca dari **Portfolio Content > Contact Messages**.
- Deskripsi/title/button di contact section bisa diedit lewat **Portfolio Content > Sections > contact**.

Setelah paste update ini, jalankan dari folder root project:

```bash
docker compose exec php bash
cd /var/www/html
php artisan migrate --seed
php artisan storage:link
php artisan optimize:clear
php artisan filament:clear-cached-components
```

Kalau database masih boleh direset total:

```bash
php artisan migrate:fresh --seed
php artisan storage:link
php artisan optimize:clear
php artisan filament:clear-cached-components
```

Catatan: upload foto dari Filament akan masuk ke storage publik. Pastikan `php artisan storage:link` sudah berhasil.
