# Featured Work + Contact CMS Fix

Patch ini membuat bagian portfolio/Featured Work benar-benar bisa dikelola dari admin panel Filament.

## Menu admin yang dipakai

### Portfolio Content > Featured Work Projects
Gunakan menu ini untuk mengelola card project pada section Featured Work.

Bisa dilakukan:
- tambah project baru
- ubah nama project
- ubah deskripsi project
- upload gambar project
- isi teknologi/tags
- isi link Live Preview
- isi link Repository
- tampilkan/sembunyikan badge Featured
- tampilkan/sembunyikan project dari frontend
- hapus project
- atur urutan tampil

### Portfolio Content > Page Text / Sections
Gunakan menu ini untuk mengubah teks halaman.

Slug penting:
- `home`: nama, deskripsi hero, foto profile, dan card profile
- `about`: isi About Me
- `portfolio`: judul dan deskripsi section Featured Work
- `contact`: judul/deskripsi bagian contact dan teks tombol submit

Untuk card profile di section home, isi `Data tambahan` dengan key berikut:
- `profile_kicker`
- `profile_headline`
- `profile_description`

### Portfolio Content > Contact Messages
Pesan dari form contact frontend akan masuk ke menu ini.

## Setelah replace file

Jalankan:

```bash
docker compose exec php bash
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
