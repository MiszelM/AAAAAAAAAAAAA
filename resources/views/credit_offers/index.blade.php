<x-layouts.app title="Oferty kredytowe">
    <livewire:credit-offer-table />
    @can('create', App\Models\CreditOffer::class)
    <button>Dodaj ofertę</button>
    @endcan
</x-layouts.app>