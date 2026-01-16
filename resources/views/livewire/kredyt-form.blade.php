<form wire:submit="save" class="space-y-6">
    <flux:heading size="lg">Umowa Kredytowa</flux:heading>

    <div class="grid grid-cols-2 gap-4">
        <flux:select label="Klient" wire:model="kredyt.klient_id">
            <option value="">-- Wybierz klienta --</option>
            @foreach($klienci as $klient)
                <option value="{{ $klient->id }}">{{ $klient->nazwisko }} {{ $klient->imie }}</option>
            @endforeach
        </flux:select>

        <flux:select label="Pracownik" wire:model="kredyt.pracownik_id">
            <option value="">-- Wybierz pracownika --</option>
            @foreach($pracownicy as $pracownik)
                <option value="{{ $pracownik->id }}">{{ $pracownik->nazwisko }}</option>
            @endforeach
        </flux:select>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <flux:select label="Oferta" wire:model="kredyt.credit_offer_id">
            <option value="">-- Wybierz produkt --</option>
            @foreach($oferty as $oferta)
                <option value="{{ $oferta->id }}">{{ $oferta->name }}</option>
            @endforeach
        </flux:select>

        <flux:input label="Numer Umowy" wire:model="kredyt.numer_umowy" placeholder="np. KRE/123/2026" />
    </div>

    <flux:textarea label="Postanowienia Umowy" wire:model="kredyt.postanowienia_umowy" rows="5" />

    <div class="grid grid-cols-3 gap-4">
        <flux:input label="Kwota Wydana" type="number" step="0.01" wire:model="kredyt.kwota_wydana" icon="banknotes" />
        <flux:input label="Kwota Odsetek" type="number" step="0.01" wire:model="kredyt.kwota_odsetek" />
        <flux:input label="Liczba Rat" type="number" wire:model="kredyt.liczba_rat" />
    </div>

    <div class="grid grid-cols-3 gap-4">
        <flux:input label="Data Zawarcia" type="date" wire:model="kredyt.data_zawarcia" />
        <flux:input label="Termin Spłaty" type="date" wire:model="kredyt.termin_splaty" />
        <flux:input label="Data Wydania" type="date" wire:model="kredyt.data_wydania" />
    </div>

    <div class="grid grid-cols-2 gap-4">
        <flux:input label="Tytuł Kredytu" wire:model="kredyt.tytul_kredytu" />
        <flux:input label="Nr Rachunku do Spłat" wire:model="kredyt.nr_rachunku_do_wplat" />
    </div>

    <flux:input label="Uwagi" wire:model="kredyt.uwagi" />

    <div class="flex gap-2 justify-end">
        <flux:modal.close><flux:button variant="ghost">Anuluj</flux:button></flux:modal.close>
        <flux:button type="submit" variant="primary">Zapisz Umowę i Uruchom Kredyt</flux:button>
    </div>
</form>