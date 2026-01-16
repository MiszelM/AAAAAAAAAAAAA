<?php

namespace App\Livewire;

use App\Models\Ocena;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;

final class OcenaTable extends PowerGridComponent
{
    public string $tableName = 'ocena_table';

    public function setUp(): array
    {
        return [
            PowerGrid::header()->showSearchInput(),
            PowerGrid::footer()->showPerPage()->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Ocena::query()->with(['wniosek.klient']);
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('klient_name', fn ($model) => $model->wniosek->klient->imie . ' ' . $model->wniosek->klient->nazwisko)
            ->add('dochody', fn ($model) => number_format($model->dochody, 2, ',', ' ') . ' PLN')
            ->add('reszta', fn ($model) => number_format($model->reszta, 2, ',', ' ') . ' PLN')
            ->add('wynik_kredytowy')
            ->add('data_oceny_formatted', fn ($model) => Carbon::parse($model->data_oceny)->format('d.m.Y'));
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id'),
            Column::make('Klient', 'klient_name'),
            Column::make('Dochody', 'dochody')->sortable(),
            Column::make('Wolne środki (Reszta)', 'reszta')->sortable(),
            Column::make('Score (BIK)', 'wynik_kredytowy')->sortable(),
            Column::make('Data oceny', 'data_oceny_formatted'),
            Column::action('Akcje')
        ];
    }
}