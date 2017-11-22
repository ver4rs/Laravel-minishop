<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>



## Tutorial
- create products migration with attributes image1, image2, image3 without new table images, because this project is smaller, it is for presentation code
- create table users, products
- login, register, logout
- dashboard with form for login and register. I used bootstrap.
- admin dashboard
- managing users in admin
- managing products in admin and dashboard
- managing Cart, shopping list
- managing order. Create order, manage order for admin and user
- create Cart logic for better managing with shop



## Instalation
- Clone project
- composer install in terminal
- php artisan key:generate
- setting database connection
- php artisan migrate
- php artisan db:seed
- run
- Login as admin 
    - **email** = admin@admin.sk
    - **password** = admin


## Features 
- login and register user
- managing users
- managing products with photos
- dashboard with all products and detail info about product after click 'buy'
- shopping list
- orders
- roles admin and basic
- user must be logged in for create order

## Images
- Home | Dashboard
![home](screenshot/home.png)

- Product show
![Product show](screenshot/show-product.png)

- Shopping list
![Shopping list](screenshot/shopping-list.png)

- Create order
![Create order](screenshot/create-order.png)

- Admin managing users
![Admin managing users](screenshot/admin-users.png)

- Admin managing products
![Admin managing product list](screenshot/admin-products.png)

- Admin manage product edit
![Admin product edit](screenshot/admin-product-edit.png)

- Admin managing orders
![Admin managing orders](screenshot/admin-orders.png)

- Admin manage order info
![Admin manage order info](screenshot/admin-order-info.png)



## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb combination of simplicity, elegance, and innovation give you tools you need to build any application with which you are tasked.

## Learning Laravel

Laravel has the most extensive and thorough documentation and video tutorial library of any modern web application framework. The [Laravel documentation](https://laravel.com/docs) is thorough, complete, and makes it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 900 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for helping fund on-going Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](http://patreon.com/taylorotwell):

- **[Vehikl](http://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Styde](https://styde.net)**
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
