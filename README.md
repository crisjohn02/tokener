# Simple laravel passport token issuer for stand-alone php app

## Installation
``` composer log
composer require crisjohn02/tokener
```

## Usage
```php
use Crisjohn02\Tokener\Tokener;


$config = [
    'url' => '', // Server URL
    'id' => '', // Client ID
    'secret' => '', // Client Secret
    'username' => '', // Email/Username
    'password' => '', // Password    
];

$token = (new Tokener($config))->get();
return $token['token'];
```
