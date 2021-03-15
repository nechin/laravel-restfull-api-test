# Restfull api
Lumen + Doctrine ORM restfull api test task
# Versions
- `Lumen Framework 8.2.3`
- `Laravel Doctrine ORM 1.7.4`
# Requirements
- `PHP 7.3`
- `MySql 8.0`
# Installation
1. Clone repository
2. Start web server
3. Create and set connection to database
4. Run command: **php artisan doctrine:schema:create**
5. Import data by command **php artisan importer:run {count}**
6. Test this API by **GET** request to _**/customers**_ or _**/customers/{customerId}**_
# Using
You may add a new data provider to **_Services/DataProvider_** and set this provider in **_config/services.php_**

Custom using:
```php
$importer = app(Importer::class);
$importer->setCount(10);
$importer->run();
```
