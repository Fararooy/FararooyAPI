<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function getUsersCount();
    public function createUser(string $firstName, string $lastName, string $email, string $password): User;
    public function getUser(int $userId): Model;
    public function updateUser(int $userId, array $params): Model;
}
