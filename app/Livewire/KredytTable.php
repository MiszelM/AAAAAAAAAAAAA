<?php

namespace App\Livewire;

use App\Models\Kredyt;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;

final class KredytTable extends PowerGridComponent
{
    public string $tableName = 'kredyt_table';

    public function setUp(): array
    {
        return [
            PowerGrid::header()->showSearchInput(),
            PowerGrid::footer()->showPerPage()->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Kredyt::query()->with(['klient', 'oferta']);
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('numer_umowy')
            ->add('klient_name', fn ($model) => $model->klient->imie . ' ' . $model->klient->nazwisko)
            ->add('kwota_wydana', fn ($model) => number_format($model->kwota_wydana, 2, ',', ' ') . ' PLN')
            ->add('liczba_rat')
            ->add('termin_splaty_formatted', fn ($model) => Carbon::parse($model->termin_splaty)->format('d.m.Y'));
    }

    public function columns(): array
    {
        return [
            Column::make('Nr Umowy', 'numer_umowy')->searchable(),
            Column::make('Klient', 'klient_name'),
            Column::make('Kwota Kredytu', 'kwota_wydana')->sortable(),
            Column::make('Raty', 'liczba_rat'),
            Column::make('Termin Spłaty', 'termin_splaty_formatted'),
            Column::action('Akcje')
        ];
    }
}