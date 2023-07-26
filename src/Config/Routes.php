<?php

namespace Michalsn\CodeIgniterKinde\Config;

use Config\Services;

$routes = Services::routes();

$routes->get('login', static fn () => service('kinde')->login(), ['as' => 'login']);

$routes->get('register', static fn () => service('kinde')->register(), ['as' => 'register']);

$routes->get('logout', static fn () => service('kinde')->logout(), ['as' => 'logout', 'filter' => 'kinde']);

$routes->get('callback', static fn () => service('kinde')->callback(), ['as' => 'callback']);
