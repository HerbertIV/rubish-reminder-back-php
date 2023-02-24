<?php

namespace App\Services;

use App\Dtos\UserDto;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Services\Contracts\UserServiceContract;
use Illuminate\Support\Facades\DB;

class UserService implements UserServiceContract
{
    public function __construct(
        private UserRepositoryContract $userRepository
    ) {
    }

    public function create(UserDto $userDto): User
    {
        return DB::transaction(fn () => $this->userRepository->query()->create($userDto->toArray()));
    }

    public function first(int $id): User
    {
        return $this->userRepository->where(['id' => $id])->first();
    }

    public function deleteMany(array $ids): bool
    {
        return DB::transaction(function () use ($ids) {
            foreach ($ids as $id) {
                $this->delete($id);
            }
            return true;
        });
    }

    public function delete(int $id): bool
    {
        return DB::transaction(fn () => $this->userRepository->where(['id' => $id])->delete());
    }

    public function update(UserDto $userDto, int $id): bool
    {
        $user = $this->first($id);
        $user->fillable($userDto->toArray());
        return $user->save();
    }
}
