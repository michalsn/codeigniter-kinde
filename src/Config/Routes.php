<?php

$routes->get('login', static function () {
    return service('kinde')->login();
}, ['as' => 'login']);

$routes->get('register', static function () {
    return service('kinde')->register();
}, ['as' => 'register']);

$routes->get('logout', static function () {
    return service('kinde')->logout();
}, ['as' => 'logout', 'filter' => 'kinde']);

$routes->get('callback', static function () {
    return service('kinde')->callback();
}, ['as' => 'callback']);
