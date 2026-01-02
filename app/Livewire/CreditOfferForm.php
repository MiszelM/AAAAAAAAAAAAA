<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CreditOffer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CreditOfferForm extends Component
{
    use AuthorizesRequests;

    public CreditOffer $creditOffer;

    protected function rules(): array
    {
        return [
            'creditOffer.name' => 'required|string|max:255',
            'creditOffer.interest_rate' => 'required|numeric|min:0',
            'creditOffer.rrso' => 'required|numeric|min:0',
            'creditOffer.min_credit_score' => 'required|integer|min:0',
            'creditOffer.worker_bonus' => 'required|integer|min:0',
        ];
    }

    public function mount(?CreditOffer $creditOffer = null)
    {
        $this->creditOffer = $creditOffer ?? new CreditOffer();
    }

    public function save()
    {
        $this->authorize(
            $this->creditOffer->exists ? 'update' : 'create',
            CreditOffer::class
        );

        $this->validate();
        $this->creditOffer->save();

        session()->flash('success', 'Zapisano ofertę');
        $this->dispatch('refreshPowerGrid');
    }

    public function render()
    {
        return view('livewire.credit-offer-form');
    }
}