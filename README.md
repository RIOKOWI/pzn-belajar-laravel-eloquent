<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## #########################################################################################################

## SLIDE
https://docs.google.com/presentation/d/1popEop_YpVChJBbf5Nmj59BB9y--iS8ZGMYLzT807HA/edit

## SOURCE CODE
https://github.com/ProgrammerZamanNow/belajar-laravel-eloquent

## MEMBUAT DATABASE

contoh di file :
database.sql

LINE -

## MODEL

perintah buat model :
php artisan make:model NamaModel

perintah buat model,migration,seeding :
php artisan make:model NamaModel --migration --seed

contoh di file :
Category.php
2025_08_25_130808_create_categories_table.php
CategorySeeder.php

LINE -

## INSERT

contoh di file :
TestCase.php
CategoryTest.php

LINE 19-31

## INSERT MANY

contoh di file :
AppServiceProvider.php
CategoryTest.php

LINE 33-53

## FIND

contoh di file :
CategorySeeder.php
CategoryTest.php

LINE 56-68

## UPDATE

contoh di file :
CategoryTest.php

LINE 69-79

## SELECT

contoh di file :
CategoryTest.php

LINE 81-103

## UPDATE MANY

contoh di file :
CategoryTest.php

LINE 105-124

## DELETE

contoh di file :
CategoryTest.php

LINE 126-137

## DELETE MANY

contoh di file :
CategoryTest.php

LINE 139-160

## UUID

contoh di file :
Voucher.php
2025_08_26_122450_create_vouchers_table.php
VoucherSeeder.php
TestCase.php
VoucherTest.php

LINE 15-36

## TIMESTAMPS

contoh di file :
Comment.php
2025_08_26_122450_create_comments_table.php
CommentSeeder.php
TestCase.php
CommentTest.php

LINE 12-22

## DEFAULT ATTRIBUTE VALUES

contoh di file :
Comment.php
CommentTest.php

LINE 24-32

## FILLABLE ATTRIBUTE VALUES

contoh di file :
Category.php
CategoryTest.php

LINE 162-204

## SOFT DELETE

perintah add column :
php artisan make:migration add_deleted_at_column_to_vouchers

contoh di file :
2025_08_27_022548_add_deleted_at_column_to_vouchers.php
Voucher.php
VoucherSeeder.php
VoucherTest.php

LINE 39-53

## QUERY SCOPE

Global Scope
Local Scope

## QUERY GLOBAL SCOPE

perintah add column :
php artisan make:migration add_column_id_active_to_categories

perintah buat global scope :
php artisan make:scope IsActiveScope

contoh di file :
2025_08_27_025209_add_column_id_active_to_categories.php
IsActiveScope.php
Category.php
CategoryTest.php

LINE 227-242

## QUERY LOCAL SCOPE

perintah add column :
php artisan make:migration add_is_active_to_vouchers

contoh di file :
2025_08_27_115200_add_is_active_to_vouchers.php
Voucher.php
VoucherTest.php

LINE 56-70

## RELATIONSHIP

ONE TO ONE
ONE TO MANY
MANY TO MANY

## ONE TO ONE

contoh di file :
2025_08_27_121012_create_wallets_table.php
2025_08_27_120834_create_customers_table.php
Customer.php
Wallet.php
CustomerSeeder.php
WalletSeeder.php
TestCase.php
CustomerTest.php

LINE -

## ONE TO MANY

contoh di file :

2025_08_27_130841_create_products_table.php
Category.php
Product.php
CategorySeeder.php
ProductSeeder.php
TestCase.php
ProductTest.php
CategoryTest.php

LINE 246-257

## QUERY BUILDER RELATIONSHIP

contoh di file :

CustomerTest.php
CategoryTest.php

LINE 35-49
LINE 261-292

## HAS ONE OF MANY

contoh di file :

ProductSeeder.php
Category.php
ProductTest.php

LINE 36-44
LINE 37-51

## HAS ONE THROUGH

contoh di file :

2025_08_28_115158_create_virtual_accounts_table.php
VirtualAccount.php
VirtualAccountSeeder.php
TestCase.php

Customer.php
Wallet.php
CustomerTest.php
LINE 24-31
LINE 23-27
LINE 53-66

## HAS MANY THROUGH

contoh di file :

2025_08_28_123501_create_reviews_table.php
Review.php
ReviewSeeder.php
TestCase.php

Customer.php
Product.php
Category.php
CategoryTest.php
LINE 35-39
LINE 23-27
LINE 47-56
LINE 296-307

## MANY TO MANY

contoh di file :

2025_08_29_124926_create_table_customers_likes_products.php
TestCase.php

Customer.php
Product.php
CategoryTest.php
LINE 43-46
LINE 30-34
LINE 72-98

## INTERMEDIATE TABLE

contoh di file :

2025_08_29_132310_add_created_at_in_customers_likes_products.php

Customer.php
Product.php
CategoryTest.php
LINE 43-54
LINE 30-34
LINE 100-131

## PIVOT MODEL

contoh di file :

Like.php

Customer.php
Product.php
CategoryTest.php
LINE 43-56
LINE 30-36
LINE 133-152

## POLYMORPHIC RELATIONSHIPS
1 FK bisa lebih dari 1 tabel/model

One to One Polymorphic
One to Many Polymorphic
One of Many Polymorphic
Many to Many Polymorphic

## ONE TO ONE POLYMORPHIC

contoh di file :

2025_08_30_035520_create_images_table.php
Image.php
ImageSeeder.php
TestCase.php

Customer.php
Product.php
CustomerTest.php
LINE 59-63
LINE 39-43
LINE 156-179

## ONE TO MANY POLYMORPHIC

contoh di file :

2025_08_30_090501_add_commentable_to_comments.php
CommentSeeder.php

Comment.php
Product.php
Voucher.php
ProductTest.php
LINE 23-27
LINE 46-50
LINE 37-41
LINE 57-70

## ONE OF MANY POLYMORPHIC

contoh di file :

Product.php
ProductTest.php
LINE 53-64
LINE 72-86

## MANY TO MANY POLYMORPHIC

contoh di file :

2025_08_30_094822_create_tags_table.php
Tag.php
TagSeeder.php
TestCase.php

Product.php
Voucher.php
ProductTest.php
LINE 67-71
LINE 44-48
LINE 89-104

## POLYMORPHIC TYPES

contoh di file :

AppServiceProvider.php
ImageSeeder.php
CommentSeeder.php
ProductTest.php
LINE 33-38
LINE 21 & 27
LINE 32 & 45
LINE 69

## LAZY & EAGER LOADING

contoh di file :

Customer.php
CustomerTest.php
LINE 20
LINE 182-189

## QUERYING RELATIONS

contoh di file :

CategoryTest.php
LINE 311-320