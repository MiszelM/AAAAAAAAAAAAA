<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CreditOffer;
use Livewire\Attributes\On;
use Flux\Flux;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CreditOfferForm extends Component
{
    use AuthorizesRequests;

    public CreditOffer $creditOffer;

    public function mount(?CreditOffer $creditOffer = null)
    {
        $this->creditOffer = $creditOffer ?? new CreditOffer();
    }

    #[On('editOffer')]
    public function loadOffer($id = null)
    {
        $this->resetValidation();
        $this->creditOffer = $id ? CreditOffer::findOrFail($id) : new CreditOffer();
        $this->dispatch('modal-show', name: 'credit-offer-modal');
    }

    protected function rules(): array
    {
        return [
            'creditOffer.name' => 'required|string|max:255',
            'creditOffer.interest_rate' => 'required|numeric|min:0',
            'creditOffer.rrso' => 'required|numeric|min:0',
            'creditOffer.min_credit_score' => 'required|integer|between:300,900',
            'creditOffer.worker_bonus' => 'required|numeric|min:0',
        ];
    }

    public function save()
    {
        if ($this->creditOffer->exists) {
            $this->authorize('update', $this->creditOffer);
        } else {
            $this->authorize('create', CreditOffer::class);
        }

        $this->validate();
        $this->creditOffer->save();

        Flux::toast('Zapisano ofertę pomyślnie.');
        $this->dispatch('refreshPowerGrid');
        $this->dispatch('modal-close', name: 'credit-offer-modal');
        $this->creditOffer = new CreditOffer();
    }

    public function render()
    {
        return view('livewire.credit-offer-form');
    }
}