<h1 align="center">Middle Project HR</h1>
<br><br>

# How To Use
To use this App is very simple, you must run a simple syntax in terminal or command prompt.

### Clone The Project
```
git clone https://github.com/rizqiwahyudi/middle-project-HR.git
```

### Install The Project With Composer
```
composer install
```

### Copy ".env.example" file to ".env"
```
cp .env.example .env
```
or you can copy the file in your File Manager.

### Generate App_Key
```
php artisan key:generate
```

### Initiate The Database Migration
```
php artisan migrate
```
or You can make the seed with the following command (RECOMMENDED) :
```
php artisan migrate --seed
```

> **NOTE : Make sure the web server and database are turned on before migration command**
### And Lastly, Run the server
```
php artisan serve
```

### License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
