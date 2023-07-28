<?php

function authenticated(): bool
{
    return service('kinde')->isAuthenticated();
}

function can(string $permission): bool
{
    $kinde = service('kinde');

    return $kinde->isAuthenticated() && $kinde->getPermission($permission)['isGranted'];
}

function user_id()
{
    return user('id');
}

function user(?string $key = null)
{
    static $user = null;

    if ($user === null && service('kinde')->isAuthenticated()) {
        $profile = service('kinde')->getUserDetails();
        $user    = model('UserModel')->findByIdentity($profile['id']);
    }

    return $key === null ? $user : $user[$key] ?? null;
}

function kinde_user()
{
    if (service('kinde')->isAuthenticated()) {
        return service('kinde')->getUserDetails();
    }

    return null;
}
