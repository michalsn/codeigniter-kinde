<?php

namespace Michalsn\CodeIgniterKinde;

use BadMethodCallException;
use CodeIgniter\I18n\Time;
use Kinde\KindeSDK\Configuration;
use Kinde\KindeSDK\KindeClientSDK;
use Michalsn\CodeIgniterKinde\Config\Kinde as KindeConfig;
use Michalsn\CodeIgniterKinde\Models\UserModel;

class Kinde
{
    private KindeClientSDK $kindeClient;
    private Configuration $kindeConfig;

    public function __construct(private KindeConfig $config)
    {
        $this->kindeClient = new KindeClientSDK(
            $config->host,
            $config->redirectUrl,
            $config->clientId,
            $config->clientSecret,
            $config->grantType,
            $config->logoutRedirectUrl
        );
        $this->kindeConfig = new Configuration();
        $this->kindeConfig->setHost($config->host);
    }

    public function callback()
    {
        if (! $this->kindeClient->isAuthenticated) {

            $token = $this->kindeClient->getToken();
            $this->kindeConfig->setAccessToken($token->access_token);

            $profile = $this->kindeClient->getUserDetails();

            $userModel = model(UserModel::class);

            if ($userModel->findByIdentity($profile['id'])) {
                $user = $this->formatUserProfile($profile, true);
                $userModel->updateByIdentity($profile['id'], $user);
            } else {
                $user = $this->formatUserProfile($profile);
                $userModel->insert($profile);
            }

            return $this->config->afterCallbackSuccess();
        }

        return $this->config->afterCallbackError();
    }

    public function isAuthenticated(): bool
    {
        return $this->kindeClient->isAuthenticated;
    }

    protected function formatUserProfile(array $profile, bool $update = false): array
    {
        $data = [
            'identity'      => $profile['id'],
            'first_name'    => $profile['given_name'],
            'last_name'     => $profile['family_name'],
            'email'         => $profile['email'],
            'picture'       => $profile['picture'],
            'language'      => $this->config->defaultLanguage,
            'timezone'      => $this->config->defaultTimezone,
            'last_login_at' => Time::now('UTC')->format('Y-m-d H:i:s'),
        ];

        if ($update) {
            unset($data['language'], $data['timezone']);
        }

        return $data;
    }

    public function __call(string $name, array $args)
    {
        if (method_exists($this->kindeClient, $name)) {
            return call_user_func_array([$this->kindeClient, $name], $args);
        }

        throw new BadMethodCallException("Method {$name} does not exist in KindeClientSDK.");

    }
}
