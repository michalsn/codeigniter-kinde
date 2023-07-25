<?php

function authenticated(): bool
{
    return service('kinde')->isAuthenticated();
}

function can(string $permission): bool
{
    $kinde = service('kinde');

    return (bool) ($kinde->isAuthenticated() && $kinde->getPermission($permission)['isGranted']);
}
