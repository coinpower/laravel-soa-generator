Laravel SOA Generator
=====================
#### Links
[SOA in laravel](http://dfg.gd/blog/decoupling-your-code-in-laravel-using-repositiories-and-services)

#### Documentation
 **Installation (Laravel 4)**
 
 `$ cd /path/to/your/project/app/commands`
 
 `$ git clone https://github.com/iillexial/laravel-soa-generator.git`
 

 
Next add this line in  `app/start/artisan.php`:

`Artisan::add(new soa());`

Next execute :
 
 `$ composer dump-autoload`
 
 
 **How to use?**
 
 Create a simple SOA structure in your app:
 
 `$ php artisan soa:generate name`
 
 Example:
 
  `$ php artisan soa:generate "Users"`

 
 This command will create a this structure:
 
 `app/Services/Users/`
 
 `app/Repositories/Users/`
 
 **Create SOA in your package**:
 
 `$ php artisan soa:generate --package="vendor/name" "Users"`
 
  This command will create a this structure:

`workbench/vendor/name/src/Vendor/Name/Services/Users`

`workbench/vendor/name/src/Vendor/Name/Repositories/Users`