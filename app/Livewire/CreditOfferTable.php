<?php

namespace App\Livewire;

use App\Models\CreditOffer;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\{
    PowerGrid, PowerGridComponent, Column
};

class CreditOfferTable extends PowerGridComponent
{
    public string $tableName = 'credit_offers_table';
    public function datasource(): Builder
    {
        return CreditOffer::query();
    }
    public function setUp(): array
    {
    return [
        PowerGrid::header()->showSearchInput(),
        PowerGrid::footer()->showPerPage(),
        PowerGrid::theme('tailwind'),
    ];
    }
    public function columns(): array
    {
        return [
            Column::make('ID', 'id')->sortable(),

            Column::make('Nazwa', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Oprocentowanie', 'interest_rate')
                ->sortable(),

            Column::make('RRSO', 'rrso')
                ->sortable(),

            Column::make('Min score', 'min_credit_score')
                ->sortable(),

            Column::make('Bonus', 'worker_bonus')
                ->sortable(),
        ];
    }
}
