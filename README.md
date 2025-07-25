<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# School Uniform API — Laravel 12

## Setup

1. Clone repo and install dependencies  
```bash
git clone https://github.com/yourusername/school-uniform-api.git
cd school-uniform-api
composer install
cp .env.example .env
php artisan key:generate

```
2. Setup database in .env and run migrations
```bash
php artisan migrate
   ```
4. Database & Models
```bash
Create Students, Uniforms, Orders tables via migrations
Models: Student.php, Uniform.php, Order.php
Setup relationships:
Student hasMany Orders
Uniform hasMany Orders
Order belongsTo Student & Uniform
```
5.Controllers & Routes
```bash
php artisan make:controller StudentController --api
php artisan make:controller UniformController --api
php artisan make:controller OrderController --api
```
6. Define API routes in routes/api.php using Route::apiResource()

7. Order Logic
```bash
In OrderController@store, validate request and calculate total price
Save order with student_id, uniform_id, quantity, total_price
Return created order JSON response
```
8. Testing with Postman
   
<img width="855" height="774" alt="image" src="https://github.com/user-attachments/assets/a505bce5-ecea-4eb4-a4a2-7029ab424a1c" />

<img width="836" height="776" alt="image" src="https://github.com/user-attachments/assets/26b3db35-feda-4b20-97b8-19b4c427c8a5" />

<img width="759" height="920" alt="image" src="https://github.com/user-attachments/assets/7f2bbe7b-d575-4177-818d-e046e6843de7" />

<img width="823" height="915" alt="image" src="https://github.com/user-attachments/assets/f7081a97-a51b-480e-a34e-dd11858669a2" />

<img width="783" height="821" alt="image" src="https://github.com/user-attachments/assets/6e9bb40f-b978-4b31-b5ec-cddbafbe2224" />





