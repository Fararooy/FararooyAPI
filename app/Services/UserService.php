<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserService
{
    protected UserRepositoryInterface $userRepository;

    protected FileUploadService $fileUploadService;

    public function __construct(
        UserRepositoryInterface $userRepository,
        FileUploadService $fileUploadService
    )
    {
        $this->userRepository = $userRepository;
        $this->fileUploadService = $fileUploadService;
    }

    public function getUsersCount(): int
    {
        return $this->userRepository->getUsersCount();
    }

    public function createUser(string $firstName, string $lastName, string $email, string $password): User
    {
        return $this->userRepository->createUser($firstName, $lastName, $email, $password);
    }

    public function getUser(int $userId): Model
    {
        return $this->userRepository->getUser($userId);
    }

    public function updateUser(int $userId, array $params): Model
    {
        return $this->userRepository->updateUser($userId, $params);
    }

    public function uploadProfileImage(int $userId, Request $request): Model
    {
        $imageUrl = $this->fileUploadService->uploadProfileImage($request);
        return $this->updateUser($userId, ['profile_image' => $imageUrl]);
    }
}
