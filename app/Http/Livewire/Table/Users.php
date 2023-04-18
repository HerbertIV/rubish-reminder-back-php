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
            LinkColumn::make(__('Region'), 'region_id') // make() has no effect in this case but needs to be set anyway
                ->title(fn (User $row) => $row->region->name ?? '')
                ->location(fn (User $row) => $row->region ? route('regions.show', ['region' => $row->region]) : ''),
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

    public function builder(): Builder
    {
        return User::query()->select([
            'id',
            'first_name',
            'last_name',
            'email',
            'phone',
            'region_id',
        ]);
    }

}
