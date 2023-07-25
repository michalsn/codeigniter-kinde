<?php

function authenticated(): bool
{
    return service('kinde')->isAuthenticated();
}

function can(string $permission):bool
{
    $kinde = service('kinde');

    if ($kinde->isAuthenticated() && $kinde->getPermission($permission)['isGranted']) {
        return true;
    }

    return false;
}