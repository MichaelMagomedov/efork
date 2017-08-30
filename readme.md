
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

    $app = new App();
    $app->providers()->add(RequestProvider::class);
    $app->providers()->add(LocationProvider::class);

    $app->start();

```

# Example

# Routing
```javascript 

$app->routes()->add("GET","/user/{id}", \App\Controllers\UserController::class, "index");

```

#Provider

```javascript 

class LocationProvider implements Base
{

    public function inject(App $app)
    {
        $app->components()->singleton(Interface::class, function ($app) {
            return new Implementation($app);
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

use Engine\Implementations\App;

class UserController
{

    private $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function index($id)
    {
      --some code--
    }
}

```
   

