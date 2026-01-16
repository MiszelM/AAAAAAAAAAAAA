<?php

namespace App\Livewire;

use App\Models\Klient;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class KlientTable extends PowerGridComponent
{
    use WithExport;

    public string $tableName = 'klientTable';

    public function setUp(): array
    {
        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Klient::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('imie')
            ->add('nazwisko')
            ->add('nazwa_firmy', fn (Klient $model) => $model->nazwa_firmy ?? '-')
            ->add('adres_skrocony', fn (Klient $model) => $model->miejscowosc . ', ' . $model->ulica . ' ' . $model->nr_domu)
            ->add('nr_telefonu')
            ->add('email', fn (Klient $model) => $model->email ?? '-')
            ->add('created_at_formatted', fn (Klient $model) => Carbon::parse($model->created_at)->format('d/m/Y'));
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable(),

            Column::make('Imię', 'imie')
                ->sortable()
                ->searchable(),

            Column::make('Nazwisko', 'nazwisko')
                ->sortable()
                ->searchable(),

            Column::make('Firma', 'nazwa_firmy')
                ->sortable()
                ->searchable(),

            Column::make('Adres', 'adres_skrocony'),

            Column::make('Telefon', 'nr_telefonu')
                ->searchable(),

            Column::make('Email', 'email')
                ->searchable(),

            Column::action('Akcje')
        ];
    }

    public function actions(Klient $row): array
    {
        return [
        Button::add('edit')
        ->slot('Edytuj') // Upewnij się, że tekst jest w cudzysłowie
        ->class('text-blue-600 underline text-sm mr-3')
        ->dispatch('editKlient', ['id' => $row->id]),

        Button::add('delete')
        ->slot('Usuń')
        ->class('text-red-600 underline text-sm')
        ->dispatch('askDeleteKlient', ['id' => $row->id]),
];
    }


    public function getListeners(): array
    {
        return array_merge(parent::getListeners(), [
            'refreshPowerGrid' => '$refresh',
            'askDeleteKlient' => 'confirmDelete',
        ]);
    }

    public function confirmDelete(array $params): void
    {
        $klient = Klient::findOrFail($params['id']);
        
        // Tutaj można dodać dodatkową logikę sprawdzającą, czy klient ma przypisane kredyty
        $klient->delete();
        
        $this->dispatch('refreshPowerGrid');
        $this->js('window.Flux.toast("Klient został usunięty")');
    }
}