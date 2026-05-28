# Portfolio CMS Fix

Project ini sudah dipatch supaya konten frontend portfolio bisa diatur dari Filament Admin Panel.

## Menu Admin Baru

Buka `/admin`, lalu masuk ke group **Portfolio Content**.

- **Home Profile**: ubah nama, deskripsi hero, foto profile, tombol utama, skill/highlight, dan deskripsi card profile.
- **About Me**: ubah semua konten about, gambar, paragraf rich text, dan skill/tag.
- **Projects**: tambah, edit, hapus, hide/show project featured work.
- **Contact Section**: ubah judul, deskripsi, tombol submit, email/WhatsApp kontak.
- **Contact Messages**: lihat pesan visitor dari form frontend.
- **Links**: kelola navbar, social media, footer link.
- **Advanced Sections**: menu lanjutan untuk section tambahan seperti portfolio.
- **Site Settings**: title browser, meta description, warna accent, dan setting umum.

## Contact Form

Frontend sekarang punya form:

- Nama
- Email
- Pesan

Semua submission disimpan ke tabel `contact_submissions` dan bisa dibaca dari admin panel di **Contact Messages**.

## Setelah Replace File

Jalankan di container PHP:

```bash
cd /var/www/html
composer dump-autoload
php artisan migrate --seed
php artisan storage:link
php artisan optimize:clear
php artisan filament:clear-cached-components
```

Kalau database boleh direset:

```bash
php artisan migrate:fresh --seed
php artisan storage:link
php artisan optimize:clear
php artisan filament:clear-cached-components
```

## File Penting yang Ditambah/Diubah

- `src/app/Filament/Admin/Pages/EditHomeProfile.php`
- `src/app/Filament/Admin/Pages/EditAboutMe.php`
- `src/app/Filament/Admin/Pages/EditContactSection.php`
- `src/app/Filament/Admin/Resources/PortfolioProjectResource.php`
- `src/app/Filament/Admin/Resources/ContactSubmissionResource.php`
- `src/app/Http/Controllers/HomeController.php`
- `src/resources/views/welcome.blade.php`
- `src/public/front/portfolio-modern.css`
- `src/public/front/portfolio-modern.js`
- `src/database/migrations/2026_05_28_000004_create_contact_submissions_table.php`
