<?php

namespace App\Livewire;

use App\Models\WniosekKredytowy;
use App\Models\Klient;
use App\Models\Pracownik;
use App\Models\CreditOffer;
use Livewire\Component;
use Livewire\Attributes\On;
use Flux\Flux;

class WniosekKredytowyForm extends Component
{
    public WniosekKredytowy $wniosek;
    public bool $isEditing = false;

    protected $rules = [
        'wniosek.klient_id' => 'required|exists:klients,id',
        'wniosek.pracownik_id' => 'required|exists:pracowniks,id',
        'wniosek.credit_offer_id' => 'required|exists:credit_offers,id',
        'wniosek.data_zlozenia' => 'required|date',
        'wniosek.wnioskowana_kwota' => 'required|numeric|min:0',
        'wniosek.uwagi' => 'nullable|string|max:500',
    ];

    public function mount()
    {
        $this->wniosek = new WniosekKredytowy();
    }

    #[On('editWniosekKredytowy')]
    public function loadWniosek($id = null)
    {
        $this->resetErrorBag();
        if ($id) {
            $this->wniosek = WniosekKredytowy::find($id);
            $this->isEditing = true;
        } else {
            $this->wniosek = new WniosekKredytowy(['data_zlozenia' => now()->format('Y-m-d')]);
            $this->isEditing = false;
        }
        $this->dispatch('modal-show', name: 'wniosek-kredytowy-modal');
    }

    public function save()
    {
        $this->validate();
        $this->wniosek->save();

        Flux::toast($this->isEditing ? 'Wniosek zaktualizowany' : 'Wniosek utworzony');
        $this->dispatch('modal-close', name: 'wniosek-kredytowy-modal');
        $this->dispatch('refreshPowerGrid');
    }

    public function render()
    {
        return view('livewire.wniosek-kredytowy-form', [
            'klienci' => Klient::orderBy('nazwisko')->get(),
            'pracownicy' => Pracownik::orderBy('nazwisko')->get(),
            'oferty' => CreditOffer::all(),
        ]);
    }
}