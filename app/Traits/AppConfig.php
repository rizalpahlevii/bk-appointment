<?php

namespace App\Traits;

trait AppConfig
{
    public function getDefaultAdminUsername(): string
    {
        return 'admin';
    }

    public function getDefaultAdminPassword(): string
    {
        return 'Password123_';
    }

    public function getDefaultPassword(): string
    {
        return 'Password123_';
    }
}
