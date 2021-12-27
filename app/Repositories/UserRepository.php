<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository implements UserRepositoryInterface
{
    public function getUsersCount(): int
    {
        return User::all()->count();
    }

    public function createUser(string $firstName, string $lastName, string $email, string $password): User
    {
        $user = new User();
        $user->firstname = $firstName;
        $user->lastname = $lastName;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->about_me = '';
        $user->save();

        return $user;
    }

    public function getUser(int $userId): Model
    {
        return User::with([
            'city',
            'events',
            'favouriteEvents',
            'favouriteEvents.featuredImage',
            'registeredEvents',
            'registeredEvents.featuredImage',
        ])
            ->where('id', '=', $userId)
            ->first();
    }

    public function updateUser(int $userId, array $params): Model
    {
        User::where('id', '=', $userId)
            ->update($params);
        return $this->getUser($userId);
    }
}
