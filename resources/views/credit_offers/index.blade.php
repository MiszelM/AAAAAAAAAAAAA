<x-layouts.app>
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <flux:heading size="xl">Oferty Kredytowe</flux:heading>
                <flux:subheading>Zarządzaj dostępnymi produktami finansowymi</flux:subheading>
            </div>
            
            <flux:button variant="primary" icon="plus" @click="$dispatch('editOffer', { id: null })">
                Dodaj Ofertę
            </flux:button>
        </div>

        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-xl overflow-hidden p-6">
            <livewire:credit-offer-table />
        </div>

        {{-- Tutaj tylko WYWOŁUJEMY komponent, nie wklejamy kodu formularza --}}
        <flux:modal name="credit-offer-modal" class="min-w-[40rem]">
            <livewire:credit-offer-form />
        </flux:modal>
    </div>
</x-layouts.app>