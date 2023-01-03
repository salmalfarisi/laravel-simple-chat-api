1. update gitignore dulu

1. buat database berdasarkan data yang berasal dari .env (DB_DATABASE)
2. lakukan command berikut ini : 
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan config:clear
php artisan migrate:fresh
php artisan db:seed
php artisan key:generate
php artisan passport:install --force
php artisan serve --port=8000

note:
- untuk pengetesan API, hanya bisa dilakukan via POSTMAN. berikut ini merupakan langkah-langkahnya :
1. upload "Rakamin Academy.postman_collection.json" ke dalam postman
2. lakukan proses login
3. ambil token yang didapat dari hasil API
4. set value Bearer Token berdasarkan hasil API dari login yang telah dilakukan
- untuk masalah migrasi database dan seeder, sudah disiapkan dalam aplikasi laravel