Laravel SOA Generator
=====================
#### Links
[SOA in laravel](http://dfg.gd/blog/decoupling-your-code-in-laravel-using-repositiories-and-services)

#### Documentation
 **Installation (Laravel 4)**
 
 ```bash
$ cd /path/to/your/project/app/commands
```
 
 ```bash
$ git clone https://github.com/iillexial/laravel-soa-generator.git
```
 

 
Next add this line in  `app/start/artisan.php`:

```php
Artisan::add(new soa());
```

Next execute :
 
 ```bush
$ composer dump-autoload
```
 
 
 **How to use?**
 
 Create a simple SOA structure in your app:
 
 ```bash
$ php artisan soa:generate name
````
 
 Example:
 
  ```bash
$ php artisan soa:generate "Users"
```

 
 This command will create a this structure:
 
 `app/Services/Users/`
 
 `app/Repositories/Users/`
 
 **Create SOA in your package**:
 
 ```bash
$ php artisan soa:generate --package="vendor/name" "Users"
```
 
  This command will create a this structure:
 
`workbench/vendor/name/src/Vendor/Name/Services/Users`

`workbench/vendor/name/src/Vendor/Name/Repositories/Users`

How to add Providers and Aliases in your project you can read here:
http://dfg.gd/blog/decoupling-your-code-in-laravel-using-repositiories-and-services
