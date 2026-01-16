<form wire:submit="save" class="space-y-6">
    <flux:heading size="lg">Nowa Ocena Zdolności Kredytowej</flux:heading>

    <div class="grid grid-cols-2 gap-4">
        <flux:select label="Wniosek Kredytowy" wire:model="ocena.wniosek_kredytowy_id">
            <option value="">-- Wybierz wniosek --</option>
            @foreach($wnioski as $wniosek)
                <option value="{{ $wniosek->id }}">
                    Wniosek #{{ $wniosek->id }} - {{ $wniosek->klient->nazwisko }} {{ $wniosek->klient->imie }}
                </option>
            @endforeach
        </flux:select>

        <flux:input label="Data Oceny" type="date" wire:model="ocena.data_oceny" />
    </div>

    <div class="grid grid-cols-3 gap-4">
        {{-- Używamy .live dla natychmiastowej reakcji w metodzie updated() --}}
        <flux:input label="Dochody" type="number" step="0.01" wire:model.live="ocena.dochody" icon="banknotes" />
        <flux:input label="Wydatki Stałe" type="number" step="0.01" wire:model.live="ocena.wydatki_stale" />
        <flux:input label="Mies. Zobowiązania" type="number" step="0.01" wire:model.live="ocena.miesz_zobowiazania" />
    </div>

    <div class="grid grid-cols-3 gap-4">
        {{-- Pole Reszta jest tylko do odczytu, bo liczy je system --}}
        <flux:input label="Reszta (Dostępne)" type="number" wire:model="ocena.reszta" readonly class="bg-zinc-100" />
        <flux:input label="Liczba osób" type="number" wire:model="ocena.liczba_osob" />
        <flux:input label="Staż (miesiące)" type="number" wire:model="ocena.okres_zatrudnienia" />
    </div>

    <div class="grid grid-cols-2 gap-4">
        <flux:input label="Wynik Kredytowy (Score)" type="number" wire:model="ocena.wynik_kredytowy" />
        <flux:input label="Uwagi" wire:model="ocena.uwagi" maxlength="100" />
    </div>

    <div class="flex gap-2 justify-end">
        <flux:modal.close><flux:button variant="ghost">Anuluj</flux:button></flux:modal.close>
        <flux:button type="submit" variant="primary">Zapisz Ocenę</flux:button>
    </div>
</form>