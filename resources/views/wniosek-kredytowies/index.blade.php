<x-layouts.app>
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <flux:heading size="xl">Wnioski Kredytowe</flux:heading>
            <flux:button variant="primary" wire:click="$dispatch('editWniosekKredytowy', { id: null })">
                Dodaj Wniosek
            </flux:button>
        </div>

        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 p-4 rounded-xl">
            {{-- Wywołanie komponentu tabeli --}}
            <livewire:wniosek-kredytowy-table />
        </div>

        <flux:modal name="wniosek-kredytowy-modal" class="min-w-[45rem]">
            <livewire:wniosek-kredytowy-form />
        </flux:modal>
    </div>
</x-layouts.app>