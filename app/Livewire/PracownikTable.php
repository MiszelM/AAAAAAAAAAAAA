<?php

namespace App\Livewire;

use App\Models\Pracownik;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class PracownikTable extends PowerGridComponent
{
    public string $tableName = 'pracownikTable';

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
        return Pracownik::query();
    }

    public function fields(): PowerGridFields
    {
        // Tutaj mapujemy dane z modelu do tabeli
        return PowerGrid::fields()
            ->add('id')
            ->add('imie')
            ->add('nazwisko')
            ->add('email')
            ->add('nr_telefonu')
            ->add('stanowisko')
            ->add('wynik_bonusu');
    }

    public function columns(): array
    {
        // Tutaj definiujemy, co widzi użytkownik
        return [
            Column::make('ID', 'id'),
            Column::make('Imię', 'imie')->sortable()->searchable(),
            Column::make('Nazwisko', 'nazwisko')->sortable()->searchable(),
            Column::make('Stanowisko', 'stanowisko')->sortable(),
            Column::make('Email', 'email')->searchable(),
            Column::make('Telefon', 'nr_telefonu'),
            Column::make('Bonus', 'wynik_bonusu')->sortable(),

            Column::action('Akcje')
        ];
    }

    public function actions(Pracownik $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edytuj')
                ->class('text-blue-600 underline text-sm mr-2')
                // Zmieniamy dispatch, aby pasował do Twojego PracownikForm
                ->dispatch('editPracownik', ['id' => $row->id]),

            Button::add('delete')
                ->slot('Usuń')
                ->class('text-red-600 underline text-sm')
                ->dispatch('askDeletePracownik', ['id' => $row->id])
        ];
    }

    // Listener do odświeżania tabeli po zapisie w formularzu
    public function getListeners(): array
    {
        return array_merge(parent::getListeners(), [
            'refreshPowerGrid' => '$refresh',
        ]);
    }
}