# Featured Work CMS Fix

Patch ini bikin card project di bagian **Featured Work** benar-benar bisa dikelola dari admin panel.

## Menu admin yang dipakai

Buka:

`/admin -> Portfolio Content -> Featured Work`

Dari menu itu kamu bisa:

- tambah project baru
- edit nama project
- edit deskripsi project
- upload gambar project
- edit teknologi/tags
- edit link Live Preview
- edit link Repository
- show/hide badge Featured
- show/hide project dari frontend
- hapus project
- atur urutan tampil

## Pesan contact

Frontend sekarang punya form contact: nama, email, pesan.

Pesan yang masuk bisa dilihat dari:

`/admin -> Portfolio Content -> Contact Messages`

## Setelah replace file

Jalankan dari root project:

```bash
docker compose exec php bash
cd /var/www/html
composer dump-autoload
php artisan migrate --seed
php artisan storage:link
php artisan optimize:clear
php artisan filament:clear-cached-components
php artisan filament:cache-components
```

Kalau menu belum muncul, logout dari admin panel lalu login lagi.
