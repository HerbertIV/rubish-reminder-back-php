<?php

namespace App\Services\Contracts;

use App\Dtos\UserDto;
use App\Models\User;

interface UserServiceContract
{
    public function create(UserDto $userDto): User;
    public function first(int $id): User;
    public function deleteMany(array $ids): bool;
    public function delete(int $id): bool;
    public function update(UserDto $userDto, int $id): bool;
    public function setProcessEmail(string $token): bool;
}
