<?php

namespace App\DataTransferObject;

use DateTime;

class AdminRegistrationDTO
{
    private function __construct(
        public readonly string $username,
        public readonly string $email,
        public readonly string $password_hash,
        public readonly DateTime $created_at,
        public readonly DateTime $updated_at
    ) {}

    public static function create(string $username, string $email, string $password_hash, DateTime $created_at,
                                  DateTime $updated_at): AdminRegistrationDTO
    {
        return new self($username, $email, $password_hash, $created_at, $updated_at);
    }
}