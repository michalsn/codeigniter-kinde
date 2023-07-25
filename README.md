# CodeIgniter Kinde

Basic integration for [Kinde](https://kinde.com/) authentication.

[![PHPUnit](https://github.com/michalsn/codeigniter-kinde/actions/workflows/phpunit.yml/badge.svg)](https://github.com/michalsn/codeigniter-kinde/actions/workflows/phpunit.yml)
[![PHPStan](https://github.com/michalsn/codeigniter-kinde/actions/workflows/phpstan.yml/badge.svg)](https://github.com/michalsn/codeigniter-kinde/actions/workflows/phpstan.yml)
[![Deptrac](https://github.com/michalsn/codeigniter-kinde/actions/workflows/deptrac.yml/badge.svg)](https://github.com/michalsn/codeigniter-kinde/actions/workflows/deptrac.yml)

![PHP](https://img.shields.io/badge/PHP-%5E8.0-blue)
![CodeIgniter](https://img.shields.io/badge/CodeIgniter-%5E4.3-blue)

### Installation

#### Composer

    composer require michalsn/codeigniter-kinde

#### Manually

In the example below we will assume, that files from this project will be located in `app/ThirdParty/kinde` directory.

Download this project and then enable it by editing the `app/Config/Autoload.php` file and adding the `Michalsn\CodeIgniterKinde` namespace to the `$psr4` array, like in the below example:

```php
<?php

namespace Config;

use CodeIgniter\Config\AutoloadConfig;

class Autoload extends AutoloadConfig
{
    // ...
    public $psr4 = [
        APP_NAMESPACE => APPPATH, // For custom app namespace
        'Config'      => APPPATH . 'Config',
        'Michalsn\CodeIgniterKinde' => APPPATH . 'ThirdParty/kinde/src',
    ];

    // ...
```
Also add the required helper to the same file under `$files` array:

```php
    // ...
    public $files = [
        APPPATH . 'ThirdParty/kinde/src/Common.php',
    ];

    // ...
```

### Helper functions

- `authenticated()` will check if current user is authenticated
- `can($permission)` will check if current user has a permission

### Example

```php
<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (! service('kinde')->isAuthenticated()) {
            return $this->response->setHeader(401)->setBody('401 Unauthorized');
        }

        if (! can('home:view')) {
            return $this->response->setHeader(401)->setBody('Not enough permissions to view this page');
        }

        return view('home/index', $data);
    }
}
```
