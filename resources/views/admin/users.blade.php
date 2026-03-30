<x-app-layout>
    <x-slot name="header"> Svi korisnici 🌙 جميع المستخدمين </x-slot>

    @if(session('success'))
        <div class="alert-success">✓ {{ session('success') }}</div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-3">Ime</th>
                            <th class="px-6 py-3">Email</th>
                            <th class="px-6 py-3">Uloga</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Upozorenja</th>
                            <th class="px-6 py-3">Akcija</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4">
                                {{ $user->role === 'teacher' ? 'Učitelj' : 'Učenik' }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded text-xs
                                    {{ $user->status === 'approved' ? 'bg-green-100 text-green-700' : 
                                       ($user->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 
                                       'bg-red-100 text-red-700') }}">
                                    {{ $user->status === 'approved' ? 'Odobren' : 
                                       ($user->status === 'pending' ? 'Na čekanju' : 'Odbijen') }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $user->warning_count }}</td>
                            <td class="px-6 py-4 flex gap-2">
                                {{-- Upozorenje --}}
                                <form method="POST" action="{{ route('admin.warn-user', $user) }}">
                                    @csrf
                                    <button class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                                        Upozori
                                    </button>
                                </form>
                                {{-- Brisanje --}}
                                <form method="POST" action="{{ route('admin.delete-user', $user) }}"
                                      onsubmit="return confirm('Sigurno želiš obrisati ovog korisnika?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
                                        Obriši
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-4">{{ $users->links() }}</div>
            </div>

        </div>
    </div>
</x-app-layout>