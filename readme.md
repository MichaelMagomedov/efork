
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
                                   
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.*)$ index.php [QSA,L
</IfModule>

# index.php                                      

require __DIR__ . '/../vendor/autoload.php';
use Engine\Core\Providers\LocationProvider;
use Engine\Core\Providers\RequestProvider;
use Engine\Implementations\App;
$app = new App();
$app->providers()->add(RequestProvider::class);
$app->providers()->add(LocationProvider::class);
$app->routes()->add("/user/{id}", \App\Controllers\UserController::class, "index");
$app->start();

