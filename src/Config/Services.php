<?php

namespace Michalsn\CodeIgniterKinde\Config;

use CodeIgniter\Config\BaseService;
use Michalsn\CodeIgniterKinde\Config\Kinde as KindeConfig;
use Michalsn\CodeIgniterKinde\Kinde;

class Services extends BaseService
{
    /**
     * Return the kinde class.
     */
    public static function kinde(?KindeConfig $config = null, bool $getShared = true): Kinde
    {
        if ($getShared) {
            return static::getSharedInstance('kinde', $config);
        }

        $config ??= config(KindeConfig::class);

        return new Kinde($config);
    }
}
