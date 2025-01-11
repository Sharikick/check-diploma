<?php

namespace App\Kernel\Database;

interface DatabaseInterface
{
    public function disconnect(): void;
    public function insert(string $table, array $data): int;
    public function existUserByEmail(string $email): bool;
}
