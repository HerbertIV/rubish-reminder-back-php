<?php

namespace App\Http\Livewire\Table;

use App\Models\Region;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Regions extends DataTableComponent
{
    protected $model = Region::class;

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
        ];
    }

    public function query(): Builder
    {
        return Region::query();
    }

}
