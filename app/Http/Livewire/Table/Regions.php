<?php

namespace App\Http\Livewire\Table;

use App\Models\Region;
use App\Services\Contracts\RegionServiceContract;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class Regions extends DataTableComponent
{
    private RegionServiceContract $regionService;
    protected $model = Region::class;

    public function __construct($id = null)
    {
        $this->regionService = app(RegionServiceContract::class);
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
            Column::make('Parent', 'parent_id')
                ->sortable(),
            Column::make('Name')
                ->sortable(),
            ButtonGroupColumn::make('Actions')
                ->attributes(function($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('View') // make() has no effect in this case but needs to be set anyway
                    ->title(fn($row) => 'View')
                        ->location(fn($row) => route('regions.show', ['region' => $row]))
                        ->attributes(function($row) {
                            return [
                                'class' => 'underline text-blue-500 hover:no-underline',
                            ];
                        }),
                    LinkColumn::make('Edit')
                        ->title(fn($row) => 'Edit')
                        ->location(fn($row) => route('regions.edit', ['region' => $row]))
                        ->attributes(function($row) {
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
        $this->regionService->deleteMany($this->getSelected());
        $this->clearSelected();
    }

    public function query(): Builder
    {
        return Region::query();
    }

}
