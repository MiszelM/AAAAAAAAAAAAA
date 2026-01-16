<?php

namespace App\Livewire;

use App\Models\CreditOffer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\{Button, Column, PowerGridComponent, PowerGridFields};

final class CreditOfferTable extends PowerGridComponent
{
    use AuthorizesRequests;

    public string $tableName = 'credit_offers_table';

    public function setUp(): array
    {
        return [
            PowerGrid::header()->showSearchInput(),
            PowerGrid::footer()->showPerPage()->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return CreditOffer::query();
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('interest_rate', fn ($model) => $model->interest_rate . '%')
            ->add('rrso', fn ($model) => $model->rrso . '%')
            ->add('min_credit_score')
            ->add('worker_bonus', fn ($model) => $model->worker_bonus . '%');
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')->sortable(),
            Column::make('Nazwa Oferty', 'name')->sortable()->searchable(),
            Column::make('Oprocentowanie', 'interest_rate'),
            Column::make('RRSO', 'rrso'),
            Column::make('Min. Score', 'min_credit_score'),
            Column::make('Bonus', 'worker_bonus'),
            Column::action('Akcje')
        ];
    }

    public function actions(CreditOffer $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edytuj')
                ->class('text-blue-600 underline text-sm mr-2')
                ->dispatch('editOffer', ['id' => $row->id]),

            Button::add('delete')
                ->slot('Usuń')
                ->class('text-red-600 underline text-sm')
                ->confirm('Czy na pewno chcesz usunąć tę ofertę?')
                ->dispatch('askDelete', ['id' => $row->id]),
        ];
    }

    public function getListeners(): array
    {
        return array_merge(parent::getListeners(), [
            'refreshPowerGrid' => '$refresh',
            'askDelete',
            // This line below allows the table to refresh when modal saves
        ]);
    }

    public function askDelete(int $id): void
    {   
        $offer = CreditOffer::findOrFail($id);
        $this->authorize('delete', $offer);
        $offer->delete();
        $this->dispatch('refreshPowerGrid');
    }
}