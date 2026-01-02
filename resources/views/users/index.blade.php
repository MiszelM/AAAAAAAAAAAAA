<x-layouts.app title="Użytkownicy">

<h1 class="text-xl font-bold mb-4">Użytkownicy</h1>

<form method="GET" class="mb-4 flex gap-2">
    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Szukaj..."
        class="border px-2 py-1"
    >
    <select name="sort" class="border px-2 py-1">
        <option value="">Sortuj</option>
        <option value="name">Nazwa</option>
        <option value="email">Email</option>
    </select>
    <button class="border px-3 py-1">Filtruj</button>
</form>

<table class="border w-full">
    <thead>
        <tr>
            <th class="border px-2">ID</th>
            <th class="border px-2">Nazwa</th>
            <th class="border px-2">Email</th>
            <th class="border px-2">Role</th>
            <th class="border px-2">Akcje</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td class="border px-2">{{ $user->id }}</td>
            <td class="border px-2">{{ $user->name }}</td>
            <td class="border px-2">{{ $user->email }}</td>
            <td class="border px-2">
                {{ $user->roles->pluck('name')->join(', ') ?: '-' }}
            </td>
            <td class="border px-2">
                @can('users.assign_role')
                <form method="POST" action="{{ route('users.role', $user) }}">
                    @csrf
                    <select name="role">
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}">
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    <button class="border px-2">Zmień</button>
                </form>
                @endcan
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $users->links() }}
</div>

</x-layouts.app>