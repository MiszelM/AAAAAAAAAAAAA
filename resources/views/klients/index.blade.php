<x-layouts.app>
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <flux:heading size="xl">Baza Klientów</flux:heading>
                <flux:subheading>Zarządzaj danymi swoich klientów i ich historią</flux:subheading>
            </div>
            
            <flux:button variant="primary" icon="plus" wire:click="$dispatch('editKlient', { id: null })">
            Dodaj Klienta
            </flux:button>
        </div>


        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-xl overflow-hidden">
            <div class="p-6">
                <livewire:klient-table />
            </div>
        </div>

        <flux:modal name="klient-modal" class="min-w-[40rem]">
            <livewire:klient-form />
        </flux:modal>
    </div>
</x-layouts.app>