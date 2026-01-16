<div>
<form wire:submit="save" class="space-y-6">
    <flux:heading size="lg">
        {{ $pracownik->exists ? 'Edytuj pracownika' : 'Nowy pracownik' }}
    </flux:heading>

    <div class="grid grid-cols-2 gap-4">
        <flux:input label="Imię" wire:model="pracownik.imie" />
        <flux:input label="Nazwisko" wire:model="pracownik.nazwisko" />
    </div>

    <flux:input label="Email" type="email" wire:model="pracownik.email" placeholder="jan@kowalski.pl" />
    
    <flux:input 
        label="Nr telefonu" 
        wire:model="pracownik.nr_telefonu" 
        placeholder="+48 000 000 000" 
    />

    <div class="grid grid-cols-2 gap-4">
        <flux:input label="Stanowisko" wire:model="pracownik.stanowisko" />
        <flux:input type="number" label="Wynik bonusu" wire:model="pracownik.wynik_bonusu" />
    </div>

    <div class="flex gap-2 justify-end">
        <flux:modal.close>
            <flux:button variant="ghost">Anuluj</flux:button>
        </flux:modal.close>
        <flux:button type="submit" variant="primary">Zapisz</flux:button>
    </div>
</form>
<div>