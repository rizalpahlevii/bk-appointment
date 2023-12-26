<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

class StaticAdminUserProvider implements UserProvider
{
    public function retrieveById($identifier)
    {
        return $this->retrieveByCredentials([]);
    }

    public function retrieveByCredentials(array $credentials): ?Authenticatable
    {
        if ($credentials['username'] === 'admin' && $credentials['password'] === 'admin') {
            return new class implements Authenticatable {
                public function getAuthIdentifierName()
                {
                    return 'username';
                }

                public function getAuthIdentifier()
                {
                    return 'admin';
                }

                public function getAuthPassword()
                {
                    return 'admin';
                }

                public function getRememberToken()
                {
                }

                public function setRememberToken($value)
                {
                }

                public function getRememberTokenName()
                {
                }
            };
        }
        return null;
    }

    public function retrieveByToken($identifier, $token)
    {
        return $this->retrieveByCredentials([]);
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        return null;
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return $credentials['username'] === $user->getAuthIdentifier() &&
            $credentials['password'] === $user->getAuthPassword();
    }
}
