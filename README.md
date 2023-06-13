# Aplikasi Photo Sharing (ShareCare)
ShareCare adalah aplikasi berbagi foto yang memungkinkan pengguna untuk melakukan login, membuat akun baru, melihat daftar foto, menggunggah foto, memperbarui caption dan tags pada foto, serta menyukai atau tidak menyukai foto.

## Fitur
- Login pengguna mengunakan email dan password.
- Register.
- Melihat daftar foto yang tersedia.
- Menggunggah foto beserta caption dan tags.
- Memperbarui caption dan tags pada foto yang sudah diunggah.
- Menyukai atau tidak menyukai foto.

## Instalasi
1. Clone repository ini ke direktori lokal Anda:
```shell
git clone https://github.com/akiraoka29/photo-sharing-app.git
```
2. Masuk ke direktori proyek:
```shell
cd photo-sharing-app
```
3. Install dependencies menggunakan Composer:
```shell
composer install
```
4. Install dependencies menggunakan NPM:
```shell
npm install
```
5. Salin file `.env.example` menjadi `.env`:
```shell
cp .env.example .env
```
6. Generate key aplikasi:
```shell
php artisan key:generate
```
7. Generate secret key dari JWT untuk fitur authentication:
```shell
php artisan jwt:secret
```
8. Atur konfigurasi database pada file '.env' sesuai dengan lingkungan Anda:
```shell
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=username_database
DB_PASSWORD=password_database
```
9. Jalankan migrasi untuk membuat tabel-tabel yang diperlukan:
```shell
php artisan migrate
```
10. (Optional) Jalankan seeder untuk membuat data dummy yang diperlukan kedalam tabel yang sudah dibuat:
```shell
php artisan db:seed
```
11. Jalankan fungsi laravel mix menggunakan NPM:
```shell
npm run dev
```
12. Jalankan perintah berikut untuk membuat symlink antara direktori public dengan direktori storage
```shell
php artisan storage:link
```
13. Jalankan server lokal:
```shell
php artisan serve
```
Aplikasi akan berjalan pada `http://localhost:8000`.

## API Routes
| Action         | Method | Path                   | Keterangan                                                                              | Auth
|----------------|--------|------------------------|-----------------------------------------------------------------------------------------|--------------------
| Login          | POST   | /api/login             | Mendapatkan akses bearer token dengan melakukan login menggunakan email dan password    | No
| Register       | POST   | /api/register          | Membuat akun baru untuk mendapatkan akses login dengan menggunakan email dan password   | No
| Get Photo      | GET    | /api/photos            | Mendapatkan data array berisi foto-foto yang telah dibuat                               | No
| Create Photo   | POST   | /api/photos            | Membuat sebuah foto dari user yang sudah login                                          | Yes
| Photo Detail   | GET    | /api/photos/:id        | Mendapatkan data foto berdasarkan ID                                                    | No
| Update Photo   | PUT    | /api/photos/:id        | Memperbarui caption, dan tags pada foto yang dimiliki oleh user                         | Yes
| Delete Photo   | DELETE | /api/photos/:id        | Menghapus foto yang dimiliki oleh user                                                  | Yes
| Like Photo     | POST   | /api/photos/:id/like   | Menyukai sebuah foto                                                                    | Yes
| Unlike Photo   | POST   | /api/photos/:id/unlike | Menghapus penyukaan sebuah foto                                                         | Yes

## Environtment Variables
Berikut adalah daftar environment variables yang dapat Anda atur di file `.env`:
- `APP_NAME` - Nama Aplikasi.
- `APP_ENV` - Lingkungan aplikasi (misalnya, local, production).
- `APP_KEY` - Kunci aplikasi yang telah di-generate.
- `DB_CONNECTION` - Tipe koneksi database (misalnya, mysql, sqlite, pgsql).
- `DB_HOST` - Host database.
- `DB_PORT` - Port database.
- `DB_DATABASE` - Nama database.
- `DB_USERNAME` - Nama pengguna database.
- `DB_PASSWORD` - Password pengguna database.
- `JWT_SECRET` - Jalankan "php artisan jwt:secret" di command line Anda. 
- `JWT_ALGO` - Jalankan "php artisan jwt:secret" di command line Anda. 

Pastikan untuk mengisi nilai environment variables yang sesuai dengan lingkungan pengembangan Anda.

## Berbagi Koleksi Postman
Koleksi Postman yang berisi kumpulan permintaan API dapat dibagikan melalui tautan. Berikut adalah langkah-langkah untuk berbagi koleksi Postman ini:
1. Unduh dan instal Postman jika belum terpasang di sistem Anda. Anda dapat mengunduhnya dari https://www.postman.com/downloads/.
2. Buka Postman dan impor koleksi dengan cara berikut:
    - Klik tombol "Import" di sisi kiri atas tampilan Postman.
    - Pilih opsi "Import From Link" dan tempelkan tautan berikut: https://api.postman.com/collections/27917708-44e5e62d-0765-4f26-8db1-4b9c1a94f4d3?access_key=PMAT-01H2RCNNWTNR1MX2X1SZ4C1H5W
    - Klik tombol "Import" untuk mengimpor koleksi.
3. Setelah koleksi berhasil diimpor, Anda dapat menjelajahi dan menjalankan permintaan-permintaan API yang terkandung di dalamnya.

## Kontribusi
Jika Anda menemukan bug atau ingin berkontribusi dalam pengembangan aplikasi ini, silakan ajukan issue atau buat pull request
