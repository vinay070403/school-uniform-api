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

```bash
Aage kya karein? (Advanced / Real Use Features)
Here are 3 options — tum decide karo:

1. Upload Uniform Images (File Upload Feature)
Uniforms ke saath image bhi dikhana ho toh.

Add image column to uniforms table

Store files via Laravel’s Storage system

API accepts file via Postman (or frontend)

2. Filter/Search APIs
E.g., GET /api/uniforms?size=M, ya orders by student

Query parameters use karke search karna

Filter by size, color, student_id, etc.

3. Dashboard-style Stats API
Simple analytics ke liye

Total orders

Revenue = sum of all total_price

Top-selling uniform

Orders per student

Can return via:

bash
Copy
Edit
GET /api/stats
```
```
public function index(Request $request)
{
    $query = Uniform::query();

    if ($request->has('size')) {
        $query->where('size', $request->size);
    }

    if ($request->has('color')) {
        $query->where('color', $request->color);
    }

    return $query->get();
}
```

<img width="979" height="924" alt="image" src="https://github.com/user-attachments/assets/91260a8a-0444-4ca4-abb5-0cefdf11de46" />

```
public function index(Request $request)
{
    $query = Order::with(['student', 'uniform']);

    if ($request->has('student_id')) {
        $query->where('student_id', $request->student_id);
    }

    return $query->get();
}
```

<img width="910" height="889" alt="image" src="https://github.com/user-attachments/assets/90fa9971-197c-4313-b111-d6a52d33c3a6" />

```
 5. Test in Postman
Change method to POST

URL: http://127.0.0.1:8000/api/uniforms

Body → form-data

name: Shirt

price: 499

size: M

color: White

image: select a file (type = File)

🔚 Response
It will return the image path:

json
Copy
Edit
{
  "id": 1,
  "name": "Shirt",
  "image": "uniforms/shirt.jpg",
  ...
}
You can display it via:

php-template
Copy
Edit
<img src="http://127.0.0.1:8000/storage/uniforms/shirt.jpg" />
✅ Done bro! Now uniform images bhi save ho rahe hain.
Bolo — edit/update image feature bhi chahiye? Ya aage badhein to dashboard stats?




