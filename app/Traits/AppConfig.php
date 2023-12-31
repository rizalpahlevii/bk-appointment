<?php

namespace App\Traits;

trait AppConfig
{
    public function getDefaultPassword(): string
    {
        return 'Password123_';
    }
}
