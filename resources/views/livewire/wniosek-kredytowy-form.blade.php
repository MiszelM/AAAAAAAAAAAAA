<div>
<form wire:submit="save" class="space-y-6">
    <flux:heading size="lg">{{ $isEditing ? 'Edycja Wniosku #' . $wniosek->id : 'Nowy Wniosek Kredytowy' }}</flux:heading>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <flux:select label="Klient" wire:model="wniosek.klient_id">
            <option value="">Wybierz klienta...</option>
            @foreach($klienci as $klient)
                <option value="{{ $klient->id }}">{{ $klient->nazwisko }} {{ $klient->imie }}</option>
            @endforeach
        </flux:select>

        <flux:select label="Produkt" wire:model="wniosek.credit_offer_id">
            <option value="">Wybierz ofertę...</option>
            @foreach($oferty as $oferta)
                <option value="{{ $oferta->id }}">{{ $oferta->nazwa_kategorii }} ({{ $oferta->oprocentowanie }}%)</option>
            @endforeach
        </flux:select>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <flux:input type="date" label="Data złożenia" wire:model="wniosek.data_zlozenia" />
        <flux:input type="number" label="Kwota wnioskowana" wire:model="wniosek.wnioskowana_kwota" />
    </div>

    <flux:select label="Doradca prowadzący" wire:model="wniosek.pracownik_id">
        <option value="">Wybierz pracownika...</option>
        @foreach($pracownicy as $pracownik)
            <option value="{{ $pracownik->id }}">{{ $pracownik->nazwisko }} ({{ $pracownik->stanowisko }})</option>
        @endforeach
    </flux:select>

    <flux:textarea label="Uwagi" wire:model="wniosek.uwagi" />

    <div class="flex gap-2 justify-end">
        <flux:modal.close><flux:button variant="ghost">Anuluj</flux:button></flux:modal.close>
        <flux:button type="submit" variant="primary">Zapisz</flux:button>
    </div>
</form>
<div>