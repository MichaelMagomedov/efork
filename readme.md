
# EFork

# Composer install

```javascript
{
    "repositories": [
	  {
	    "url": "https://github.com/mikl778890/efork.git",
	    "type": "git"
	  }
	],
	"require": {
	   "efork": "dev-master"
	},
}

```

# .htaccess : 
```javascript                               
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.*)$ index.php [QSA,L
</IfModule>
```
# index.php   
                                   
```javascript 

<?php

    require __DIR__ . '/../vendor/autoload.php';
    
    use Engine\Core\Providers\LocationProvider;
    use Engine\Core\Providers\RequestProvider;
    use Engine\Implementations\App;
    use \Engine\Core\Providers\ValidatorProvider;
    
    $app = new App();
    $app->providers()->add(RequestProvider::class);
    $app->providers()->add(LocationProvider::class);
    $app->providers()->add(ValidatorProvider::class);

    $app->start();

```

# Example

# Routing

```javascript 

$app->routes()->add("GET","/user/{id}", \App\Controllers\UserController::class, "index");

$app->middlewares()->uriRegister(["auth"], [
    $app->routes()->add("GET", "/", \App\Controllers\UserController::class, "index")
]);

```
# Middlewares

```javascript 

use Engine\Contracts\App;
use Engine\Contracts\Middleware\Base;

class IndexMiddleware implements Base
{

    public function handle()
    {
     
    }
}


$app->middlewares()->add("auth", \App\Middlewares\IndexMiddleware::class);

```


# Provider

```javascript 

class LocationProvider implements Base
{

    public function inject()
    {
        app()->components()->singleton(Interface::class, function () {
            return new Implementation(app()->components()->make(Some::class));
        });
    }
}

```
# Ioc

```javascript 

$app->components()->make(SomeClass::class);

```

# Controller


```javascript 


class UserController
{

   

    public function __construct()
    {
        
    }

    public function index($id)
    {
      --some code--
    }
}

```

# Configs

```javascript

$app->configs()->add("database", [
    "pdo" => "pgsql",
    "user" => "postgres",
    "password" => "asdasd123",
    "database" => "universe",
    "host" => "localhost",
    "port" => "5432"
]);

$config = app()->configs()->get("database");


```

# App

use app() function for get access for app context;  

# Models

```javascript


namespace App\Models;

use Engine\Implementations\Models\Base;

class User extends Base
{

    protected $table = "users";

}

$users = $user->row("SELECT id FROM users WHERE email = ?", [
            $user->getEmail()
]);

```

# validation

```javascript

validator get variable by name from request

$this->validator = app()->components()->make(Validator::class);

$validateResult = $this->validator->validate([
        "email" => "req",
        "password" => "req|min{5}|max{12}",
        "name" => "req|max{12}",
]);
   
if (!$validateResult) {
          throw new \Exception("Ошибка данных");
}

```

   

