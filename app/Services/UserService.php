<?php

namespace App\Services;

use App\Dtos\UserDto;
use App\Enums\ProcessUserDataChangeEnums;
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
        $this->startProcess($userDto, $user);
        return $user->save();
    }

    public function setProcessEmail(string $token): void
    {
        //TODO;
    }

    private function startProcess(UserDto $userDto, User $user): void
    {
        if ($userDto->getEmail() && $user->email !== $userDto->getEmail()) {
            $user->process_email_expire_at = now()->modify(
                '+' . ProcessUserDataChangeEnums::PROCESS_EMAIL_CHANGE_ACTIVE . ' minutes'
            );
            $user->email_from_process = $userDto->getEmail();
            $user->process_token = md5(microtime());
        }
        if ($userDto->getPhone() && $user->phone !== $userDto->getPhone()) {
            $user->process_phone_expire_at = now()->modify(
                '+' . ProcessUserDataChangeEnums::PROCESS_PHONE_CHANGE_ACTIVE . ' minutes'
            );
            $user->phone_from_process = $userDto->getPhone();
            $user->sms_code = random_int(100000, 999999);
        }
    }
}
