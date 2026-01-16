<?php

namespace App\Livewire;

use App\Models\Pracownik;
use Livewire\Component;
use Livewire\Attributes\On;
use Flux\Flux;

class PracownikForm extends Component
{
    public Pracownik $pracownik;

    public function mount()
    {
        $this->pracownik = new Pracownik();
    }

    #[On('editPracownik')]
    public function loadPracownik($id = null)
    {
        $this->pracownik = $id ? Pracownik::find($id) : new Pracownik();
        $this->resetErrorBag();
        $this->dispatch('modal-show', name: 'pracownik-modal');
    }

    public function save()
    {
        $this->validate(Pracownik::rules());
        
        $this->pracownik->save();

        session()->flash('success', 'Dane pracownika zostały zapisane.');
        
        $this->dispatch('modal-close', name: 'pracownik-modal');
        $this->dispatch('refreshPowerGrid');
    }

    public function render()
    {
        return view('livewire.pracownik-form');
    }
}