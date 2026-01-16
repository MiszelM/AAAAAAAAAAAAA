<?php

namespace App\Livewire;

use App\Models\WniosekKredytowy;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;

final class WniosekKredytowyTable extends PowerGridComponent
{
    public string $tableName = 'wniosek_kredytowy_table';
    public function setUp(): array
    {
        return [
            PowerGrid::header()->showSearchInput(),
            PowerGrid::footer()->showPerPage()->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        // Ładujemy relacje, aby uniknąć problemu N+1
        return WniosekKredytowy::query()->with(['klient', 'pracownik', 'oferta']);
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('klient_name', fn ($model) => $model->klient->imie . ' ' . $model->klient->nazwisko)
            ->add('pracownik_name', fn ($model) => $model->pracownik->nazwisko)
            ->add('oferta_name', fn ($model) => $model->oferta->nazwa_kategorii)
            ->add('wnioskowana_kwota')
            ->add('data_zlozenia_formatted', fn ($model) => Carbon::parse($model->data_zlozenia)->format('d.m.Y'));
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id'),
            Column::make('Klient', 'klient_name'),
            Column::make('Doradca', 'pracownik_name'),
            Column::make('Produkt', 'oferta_name'),
            Column::make('Kwota', 'wnioskowana_kwota'),
            Column::make('Data złożenia', 'data_zlozenia_formatted'),
            Column::action('Akcje')
        ];
    }

    public function actions(WniosekKredytowy $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edytuj')
                ->class('text-blue-600 underline text-sm mr-2')
                ->dispatch('editWniosekKredytowy', ['id' => $row->id]),
        ];
    }
}