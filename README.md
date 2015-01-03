Laravel SOA Generator
=====================
#### Links
[SOA in laravel](http://dfg.gd/blog/decoupling-your-code-in-laravel-using-repositiories-and-services)

#### Documentation
 **Installation (Larvel 4)**
 
 `$ cd /path/to/your/project/app/commands`
 
 `$ git clone https://github.com/iillexial/laravel-soa-generator.git`
 
 **How to use?**
 
 Create a simple SOA structure in your app:
 
 `$ php artisan soa:generate name`
 
 Example:
 
  `$ php artisan soa:generate Users`

 
 This command will create a this structure:
 
 `app/Services/Users/`
 
 `app/Repositories/Users/`

