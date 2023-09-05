<?php

namespace Michalsn\CodeIgniterKinde;

use BadMethodCallException;
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
                $user = $this->config->formatUserProfile($profile, true);
                $userModel->updateByIdentity($profile['id'], $user);
            } else {
                $user = $this->config->formatUserProfile($profile);
                $userModel->insert($user);
            }

            return $this->config->afterCallbackSuccess();
        }

        return $this->config->afterCallbackError();
    }

    public function isAuthenticated(): bool
    {
        return $this->kindeClient->isAuthenticated;
    }

    public function __call(string $name, array $args)
    {
        if (method_exists($this->kindeClient, $name)) {
            return call_user_func_array([$this->kindeClient, $name], $args);
        }

        throw new BadMethodCallException("Method {$name} does not exist in KindeClientSDK.");
    }
}
