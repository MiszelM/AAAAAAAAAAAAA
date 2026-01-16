<form wire:submit="save" class="space-y-6">
    <div>
        <flux:heading size="lg">
            {{ $creditOffer->exists ? 'Edytuj Ofertę' : 'Nowa Oferta Kredytowa' }}
        </flux:heading>
    </div>

    <div class="space-y-4">
        <flux:input label="Nazwa Produktu" wire:model="creditOffer.name" placeholder="np. Kredyt Hipoteczny"/>

        <div class="grid grid-cols-2 gap-4">
            <flux:input label="Oprocentowanie (%)" type="number" step="0.01" wire:model="creditOffer.interest_rate" icon="receipt-percent" />
            <flux:input label="RRSO (%)" type="number" step="0.01" wire:model="creditOffer.rrso" icon="receipt-percent" />
        </div>

        <div class="grid grid-cols-2 gap-4">
            <flux:input label="Min. Score (BIK)" type="number" wire:model="creditOffer.min_credit_score" />
            <flux:input label="Bonus Pracownika (%)" type="number" step="0.01" wire:model="creditOffer.worker_bonus" />
        </div>
    </div>

    <div class="flex gap-2 justify-end">
        <flux:modal.close>
            <flux:button variant="ghost">Anuluj</flux:button>
        </flux:modal.close>
        <flux:button type="submit" variant="primary">Zapisz Ofertę</flux:button>
    </div>
</form>