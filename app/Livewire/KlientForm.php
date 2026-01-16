<?php

namespace App\Livewire;

use App\Models\Klient;
use Livewire\Component;
use Livewire\Attributes\On;
use Flux\Flux;

class KlientForm extends Component
{
    public Klient $klient;
    public bool $isEditing = false;

    // Definiujemy reguły walidacji (zgodne z Twoimi poprawionymi limitami)
    protected function rules()
    {
        return [
            'klient.imie' => 'required|string|max:50',
            'klient.nazwisko' => 'required|string|max:50',
            'klient.nazwa_firmy' => 'nullable|string|max:100',
            'klient.ulica' => 'required|string|max:100',
            'klient.nr_domu' => 'required|string|max:20',
            'klient.nr_lokalu' => 'nullable|integer',
            'klient.miejscowosc' => 'required|string|max:100',
            'klient.nr_telefonu' => ['required', 'regex:/^\+\d{2} \d{3} \d{3} \d{3}$/'],
            'klient.email' => 'nullable|email|max:100',
        ];
    }

    public function mount()
    {
        $this->klient = new Klient();
    }

    #[On('editKlient')]
    public function loadKlient($id = null)
    {
        $this->resetErrorBag();
        
        if ($id) {
            $this->klient = Klient::find($id);
            $this->isEditing = true;
        } else {
            $this->klient = new Klient();
            $this->isEditing = false;
        }

        // Otwiera modal o nazwie 'klient-modal' zdefiniowany w widoku index
        $this->dispatch('modal-show', name: 'klient-modal');
    }

    public function save()
    {
        $this->validate();

        $this->klient->save();

        $message = $this->isEditing ? 'Dane klienta zaktualizowane.' : 'Klient dodany pomyślnie.';
        
        // Powiadomienie Flux i odświeżenie tabeli PowerGrid
        Flux::toast($message);
        $this->dispatch('modal-close', name: 'klient-modal');
        $this->dispatch('refreshPowerGrid'); 
    }

    public function render()
    {
        return view('livewire.klient-form');
    }
}