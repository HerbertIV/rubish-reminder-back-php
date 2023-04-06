<?php

declare(strict_types = 1);

namespace App\Http\Livewire;

use App\Dtos\UserDto;
use App\Http\Requests\UserPhoneProcessRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\Contracts\UserServiceContract;
use Illuminate\Support\Str;
use Livewire\Component;

class UserPhoneProcessForm extends Component
{
    private UserServiceContract $userService;
    public ?int $smsCode = null;
    public ?string $token = '';
    public string $action;
    public array $button;

    public function __construct(
        $id = null
    ) {
        $this->userService = app(UserServiceContract::class);
        parent::__construct($id);
    }

    protected function getRules()
    {
        return (new UserPhoneProcessRequest)->rules();
    }

    public function userPhoneProcessVerify(): void
    {
        $this->resetErrorBag();
        $this->validate();
        $user = $this->userService->setProcessPhone(
            $this->getToken(),
            $this->getSmsCode()
        );
        if (!$user) {
            $this->addError('smsCode', __('Wrong sms code'));
        } else {
            $this->emit('saved');
            $this->redirect(route('users.show', $user));
        }
    }

    public function mount(?string $token = ''): void
    {
        $this->token = $token;
        $this->button = create_button($this->action, 'User');
    }

    public function render()
    {
        return view('pages.user.components.user-phone-process-form');
    }

    public function getSmsCode(): ?int
    {
        return $this->smsCode ?? null;
    }

    public function getToken(): ?string
    {
        return $this->token ?? null;
    }
}
