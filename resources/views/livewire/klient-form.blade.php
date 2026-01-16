<div>
<form wire:submit="save" class="space-y-6">
    <div>
        <flux:heading size="lg">{{ $isEditing ? 'Edycja Klienta' : 'Nowy Klient' }}</flux:heading>
        <flux:subheading>Wprowadź dane identyfikacyjne i adresowe.</flux:subheading>
    </div>

    <flux:separator />

    <div class="grid grid-cols-2 gap-4">
        <flux:input label="Imię" wire:model="klient.imie" placeholder="np. Jan" />
        <flux:input label="Nazwisko" wire:model="klient.nazwisko" placeholder="np. Kowalski" />
    </div>

    <flux:input label="Nazwa Firmy (opcjonalnie)" wire:model="klient.nazwa_firmy" />

    <div class="grid grid-cols-3 gap-4">
        <div class="col-span-2">
            <flux:input label="Ulica" wire:model="klient.ulica" />
        </div>
        <div class="flex gap-2">
            <flux:input label="Nr domu" wire:model="klient.nr_domu" />
            <flux:input label="Lokal" wire:model="klient.nr_lokalu" />
        </div>
    </div>

    <flux:input label="Miejscowość" wire:model="klient.miejscowosc" />

    <div class="grid grid-cols-2 gap-4">
        <flux:input label="Telefon" wire:model="klient.nr_telefonu" placeholder="+48 000 000 000" />
        <flux:input label="E-mail" type="email" wire:model="klient.email" />
    </div>

    <div class="flex gap-2 justify-end">
        <flux:modal.close>
            <flux:button variant="ghost">Anuluj</flux:button>
        </flux:modal.close>
        <flux:button type="submit" variant="primary">Zapisz zmiany</flux:button>
    </div>
</form>
<div>