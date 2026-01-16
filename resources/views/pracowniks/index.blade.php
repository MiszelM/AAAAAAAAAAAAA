<x-layouts.app>
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <flux:heading size="xl">Kadry: Pracownicy</flux:heading>
                <flux:subheading>Zarządzaj zespołem i weryfikuj wyniki bonusowe</flux:subheading>
            </div>
            
            <flux:button variant="primary" icon="plus" wire:click="$dispatch('editPracownik', { id: null })">
                Dodaj Pracownika
            </flux:button>
        </div>

        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-xl overflow-hidden">
            <div class="p-6">
                <livewire:pracownik-table />
            </div>
        </div>

        <flux:modal name="pracownik-modal" class="min-w-[40rem]">
            <livewire:pracownik-form />
        </flux:modal>
    </div>
</x-layouts.app>