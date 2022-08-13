<h1 style="text-align:center">Realtime chat application with Vue.js/Laravel</h1>
<br>


## Requirements

-   PHP >= 7.3

## Description

<p>Il s'agit de l'application complète de chat multiple en temps réel. cette application est basée sur deux rôles (fournisseurs et client)</p>

## App Screenshot
<img src="public\assets\screenshot\account.png">
<img src="public\assets\screenshot\converstaion.png">

## Intstallation

 * Execute the following commands in order
 # install dependencies
npm install
composer install
# serve with hot reload at localhost:8080
npm run dev
php artisan serve

 * Set up the **DataBase**
``` bash
DB_HOST=127.0.0.1
DB_PORT=3306
DB_USERNAME=
DB_PASSWORD=
DB_CONNECTION=chat
DB_DATABASE=
```

``` bash
php artisan migrate
php artisan key:generate
php artisan storage:link
php artisan optimize
php artisan route:clear
```
