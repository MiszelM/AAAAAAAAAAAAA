<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ocena;
use App\Models\WniosekKredytowy;
use Livewire\Attributes\On;
use Flux\Flux;

class OcenaForm extends Component
{
    // Właściwość w liczbie pojedynczej, zgodnie z modelem
    public Ocena $ocena;

    public function mount()
    {
        $this->ocena = new Ocena([
            'data_oceny' => now()->format('Y-m-d'),
            'reszta' => 0,
        ]);
    }

    #[On('editOcena')]
    public function loadOcena($id = null)
    {
        $this->resetValidation();
        $this->ocena = $id ? Ocena::findOrFail($id) : new Ocena(['data_oceny' => now()->format('Y-m-d'), 'reszta' => 0]);
        $this->dispatch('modal-show', name: 'ocena-modal');
    }

    /**
     * Reaktywne wyliczanie pola 'reszta' przy zmianie składowych finansowych.
     * Wykorzystujemy wire:model.live w widoku.
     */
    public function updated($propertyName)
    {
        if (in_array($propertyName, ['ocena.dochody', 'ocena.wydatki_stale', 'ocena.miesz_zobowiazania'])) {
            $dochody = (float)($this->ocena->dochody ?? 0);
            $wydatki = (float)($this->ocena->wydatki_stale ?? 0);
            $zobowiazania = (float)($this->ocena->miesz_zobowiazania ?? 0);
            
            $this->ocena->reszta = $dochody - $wydatki - $zobowiazania;
        }
    }

    protected function rules(): array
    {
        return [
            'ocena.wniosek_kredytowy_id' => 'required|exists:wniosek_kredytowies,id',
            'ocena.data_oceny' => 'required|date',
            'ocena.dochody' => 'required|numeric|min:0',
            'ocena.okres_zatrudnienia' => 'required|integer|min:0',
            'ocena.liczba_osob' => 'required|integer|min:1',
            'ocena.wydatki_stale' => 'required|numeric|min:0',
            'ocena.miesz_zobowiazania' => 'required|numeric|min:0',
            'ocena.reszta' => 'required|numeric',
            'ocena.wynik_kredytowy' => 'required|integer|between:0,1000',
            'ocena.uwagi' => 'nullable|string|max:100',
        ];
    }

    public function save()
    {
        $this->validate();
        $this->ocena->save();

        Flux::toast('Ocena kredytowa została zapisana.');
        $this->dispatch('refreshPowerGrid');
        $this->dispatch('modal-close', name: 'ocena-modal');
    }

    public function render()
    {
        return view('livewire.ocena-form', [
            'wnioski' => WniosekKredytowy::with('klient')->get(),
        ]);
    }
}