<?php

namespace App\DTOs;

class UserDTO
{
    public function __construct(
        public string $type,
        public        $data
    )
    {
    }
}
