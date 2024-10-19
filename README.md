<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Steps To Run The Project

- make sure the installed php version in your pc is is 8.3.x
- clone the project repository
- move to the working directory
- duplicate the ```.env.example``` and rename the duplicated file into ```.env```
- execute commands below and type ```yes``` for all incoming questions
```
composer install

php artisan install:api

php artisan migrate:fresh --seed
```
- finally, execute ```php artisan serve``` to run the project server. all api routes in the project are having ```/api``` prefix after the base url. usually, the project will run at ```http://127.0.0.1:8000```
