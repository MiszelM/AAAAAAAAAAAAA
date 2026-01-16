<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Kredyt;
use App\Models\Klient;
use App\Models\Pracownik;
use App\Models\CreditOffer;
use App\Models\WniosekKredytowy;
use Flux\Flux;
use Livewire\Attributes\On;

class KredytForm extends Component
{
    public Kredyt $kredyt;

    public function mount()
    {
        $this->kredyt = new Kredyt([
            'data_zawarcia' => now()->format('Y-m-d'),
            'data_wydania' => now()->format('Y-m-d'),
            'termin_splaty' => now()->addYears(2)->format('Y-m-d'),
        ]);
    }

    #[On('editKredyt')]
    public function loadKredyt($id = null)
    {
        $this->resetValidation();
        $this->kredyt = $id ? Kredyt::findOrFail($id) : new Kredyt([
            'data_zawarcia' => now()->format('Y-m-d'),
            'data_wydania' => now()->format('Y-m-d'),
        ]);
        $this->dispatch('modal-show', name: 'kredyt-modal');
    }

    protected function rules(): array
    {
        return [
            'kredyt.klient_id' => 'required|exists:klients,id',
            'kredyt.pracownik_id' => 'required|exists:pracowniks,id',
            'kredyt.credit_offer_id' => 'required|exists:credit_offers,id',
            'kredyt.wniosek_kredytowy_id' => 'nullable|exists:wniosek_kredytowies,id',
            'kredyt.numer_umowy' => 'required|string|max:20',
            'kredyt.postanowienia_umowy' => 'required|string|max:4000',
            'kredyt.kwota_wydana' => 'required|numeric|min:0',
            'kredyt.kwota_odsetek' => 'required|numeric|min:0',
            'kredyt.data_zawarcia' => 'required|date',
            'kredyt.data_wydania' => 'required|date',
            'kredyt.tytul_kredytu' => 'required|string|max:50',
            'kredyt.termin_splaty' => 'required|date',
            'kredyt.liczba_rat' => 'required|integer|min:1',
            'kredyt.nr_rachunku_do_wplat' => 'required|string|max:30',
            'kredyt.uwagi' => 'nullable|string|max:500',
        ];
    }

    public function save()
    {
        $this->validate();
        $this->kredyt->save();

        Flux::toast('Umowa kredytowa została zapisana.');
        $this->dispatch('refreshPowerGrid');
        $this->dispatch('modal-close', name: 'kredyt-modal');
    }

    public function render()
    {
        return view('livewire.kredyt-form', [
            'klienci' => Klient::all(),
            'pracownicy' => Pracownik::all(),
            'oferty' => CreditOffer::all(),
            'wnioski' => WniosekKredytowy::all(),
        ]);
    }
}