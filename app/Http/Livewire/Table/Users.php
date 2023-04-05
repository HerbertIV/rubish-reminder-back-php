<?php

namespace App\Http\Livewire\Table;

use App\Models\User;
use App\Services\Contracts\UserServiceContract;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class Users extends DataTableComponent
{
    private UserServiceContract $userService;
    protected $model = User::class;

    public function __construct($id = null)
    {
        $this->userService = app(UserServiceContract::class);
        parent::__construct($id);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable(),
            Column::make(__('First name'), 'first_name')
                ->sortable(),
            Column::make(__('Last name'), 'last_name')
                ->sortable(),
            Column::make(__('Email'), 'email')
                ->sortable(),
            Column::make(__('Phone'), 'phone')
                ->sortable(),
            Column::make(__('Active'))
                ->sortable(),
            ButtonGroupColumn::make('Actions')
                ->attributes(function ($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('View') // make() has no effect in this case but needs to be set anyway
                    ->title(fn ($row) => 'View')
                        ->location(fn ($row) => route('users.show', ['user' => $row]))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'underline text-blue-500 hover:no-underline',
                            ];
                        }),
                    LinkColumn::make('Edit')
                        ->title(fn($row) => 'Edit')
                        ->location(fn($row) => route('users.edit', ['user' => $row]))
                        ->attributes(function ($row) {
                            return [
                                'target' => '_blank',
                                'class' => 'underline text-blue-500 hover:no-underline',
                            ];
                        })
                ]),
        ];
    }

    public function bulkActions(): array
    {
        return [
            'remove' => 'Remove',
        ];
    }

    public function remove()
    {
        $this->userService->deleteMany($this->getSelected());
        $this->clearSelected();
    }

    public function query(): Builder
    {
        return User::query();
    }

}
