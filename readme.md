
                    E-fork

 _______________________________________________
|                                               |
|.htaccess :                                    |
|_______________________________________________|
|                                               |
|#Check if module is turned on.                 |
|<IfModule mod_rewrite.c>                       |
|    RewriteEngine On                           |
|    RewriteCond %{REQUEST_FILENAME} !-f        |
|    RewriteRule ^(.*)$ index.php [QSA,L]       |
|</IfModule>                                    |
|_______________________________________________|
|                                               |
|index.php                                      |
|_______________________________________________|
|                                               |
|require __DIR__ . '/../vendor/autoload.php';   |
|use Engine\Core\Providers\LocationProvider;    |
|use Engine\Core\Providers\RequestProvider;     |
|use Engine\Implementations\App;                | 
|$app = new App();                              |                                               |
|$app->providers()->add(RequestProvider::class);|
|$app->providers()->add(LocationProvider::class);|__________________________________
|$app->routes()->add("/user/{id}", \App\Controllers\UserController::class, "index");|
|$app->start();                                  ___________________________________|
|_______________________________________________|

