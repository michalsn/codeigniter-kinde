<?php

namespace Michalsn\CodeIgniterKinde\Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\I18n\Time;
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

    public function formatUserProfile(array $profile, bool $update = false): array
    {
        $data = [
            'identity'      => $profile['id'],
            'first_name'    => $profile['given_name'],
            'last_name'     => $profile['family_name'],
            'email'         => $profile['email'],
            'picture'       => $profile['picture'],
            'language'      => $this->defaultLanguage,
            'timezone'      => $this->defaultTimezone,
            'last_login_at' => Time::now('UTC')->format('Y-m-d H:i:s'),
        ];

        if ($update) {
            unset($data['language'], $data['timezone']);
        }

        return $data;
    }
}
