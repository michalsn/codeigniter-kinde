<?php

namespace Michalsn\CodeIgniterKinde\Config;

use Michalsn\CodeIgniterKinde\Filters\Kinde;

class Registrar
{
    /**
     * Register the CodeIgniterKinde filter.
     */
    public static function Filters(): array
    {
        return [
            'aliases' => [
                'kinde' => Kinde::class,
            ],
        ];
    }
}
