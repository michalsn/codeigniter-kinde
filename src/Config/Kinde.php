<?php

namespace Michalsn\CodeIgniterKinde\Config;

use CodeIgniter\Config\BaseConfig;
use Kinde\KindeSDK\Sdk\Enums\GrantType;

class Kinde extends BaseConfig
{
    public string $host              = '';
    public string $redirectUrl       = '';
    public string $logoutRedirectUrl = '';
    public string $clientId          = '';
    public string $clientSecret      = '';
    public string $grantType         = GrantType::authorizationCode;

    /**
     * User profile defaults
     */
    public string $defaultLanguage = 'pl';

    public string $defaultTimezone = 'Europe/Warsaw';

    public function afterCallbackSuccess()
    {
        return redirect()->to('/');
    }

    public function afterCallbackError()
    {
        return redirect()->to('/');
    }
}
