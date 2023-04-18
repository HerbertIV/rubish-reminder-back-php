<?php

declare(strict_types = 1);

namespace App\Http\Livewire;

use App\Dtos\UserDto;
use App\Http\Requests\UserRequest;
use App\Http\Resources\AsyncResource;
use App\Models\User;
use App\Services\Contracts\RegionServiceContract;
use App\Services\Contracts\UserServiceContract;
use Illuminate\Support\Str;
use Livewire\Component;

class UserForm extends Component
{
    private UserServiceContract $userService;
    private RegionServiceContract $regionService;
    public ?string $firstName = '';
    public ?string $lastName = '';
    public ?string $email = '';
    public ?string $phone = '';
    public ?bool $active = false;
    public ?int $regionId = null;
    public User $user;
    public string $action;
    public array $button;

    public function __construct($id = null)
    {
        $this->userService = app(UserServiceContract::class);
        $this->regionService = app(RegionServiceContract::class);
        parent::__construct($id);
    }

    protected $listeners = [
        'toggleSwitcher',
        'selectedCompanyItem',
    ];

    public function selectedCompanyItem($name, $item)
    {
        $this->$name = (int)$item;
    }

    public function toggleSwitcher(string $name, bool $value): void
    {
        $this->setData([
            $name => $value
        ]);
    }

    public function getRegionIdSelect2Format(): ?array
    {
        if ($this->regionId) {
            return AsyncResource::make($this->regionService->first($this->regionId))->resolve();
        }
        return null;
    }

    protected function getRules()
    {
        return (new UserRequest)->rules();
    }

    public function createUser(): void
    {
        $this->resetErrorBag();
        $this->validate();

        $userDto = new UserDto($this->toArray());
        $user = $this->userService->create($userDto);

        $this->emit('saved');
        $this->redirect(route('users.show', $user));
    }

    public function updateUser(): void
    {
        $this->resetErrorBag();
        $this->validate();

        $user = $this->user;
        $userDto = new UserDto($this->toArray());
        $this->userService->update($userDto, $user->getKey());

        $this->emit('updated');
        $this->redirect(route('users.show', $user));
    }

    public function mount(?User $user = null): void
    {
        if ($user) {
            $this->user = $user;
            $this->setData([
                'first_name' => $this->user->first_name,
                'last_name' => $this->user->last_name,
                'email' => $this->user->email,
                'phone' => $this->user->phone,
                'active' => $this->user->active,
                'region_id' => $this->user->region_id,
            ]);
        }
        $this->button = create_button($this->action, 'User');
    }

    public function render()
    {
        return view('pages.user.components.user-form');
    }

    public function toArray(): array
    {
        return [
            'first_name' => $this->firstName ?? '',
            'last_name' => $this->lastName ?? '',
            'email' => $this->email,
            'phone' => $this->phone ?? '',
            'active' => $this->active ?? false,
            'region_id' => $this->regionId ?? null,
        ];
    }

    public function setData(array $data): void
    {
        foreach ($data as $k => $v) {
            $key = Str::studly($k);
            if (method_exists($this, 'set' . $key)) {
                $this->{'set' . $key}($v);
            } else {
                $key = lcfirst($key);
                if (array_key_exists($key, get_class_vars(self::class))) {
                    $this->$key = $v;
                }
            }
        }
    }
}
