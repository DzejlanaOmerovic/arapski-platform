<x-app-layout>
    <x-slot name="header"> Zahtevi za registraciju 🌙 متطلبات التسجيل </x-slot>

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
                @if($users->isEmpty())
                    <p class="p-6 text-gray-500">Nema novih zahtjeva za registraciju.</p>
                @else
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-6 py-3">Ime</th>
                                <th class="px-6 py-3">Email</th>
                                <th class="px-6 py-3">Username</th>
                                <th class="px-6 py-3">Uloga</th>
                                <th class="px-6 py-3">Lokacija</th>
                                <th class="px-6 py-3">Datum</th>
                                <th class="px-6 py-3">Akcija</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $user->name }}</td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4 font-mono text-sm">{{ $user->username }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2 py-1 rounded text-xs
                                                                {{ $user->role === 'teacher' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                                            {{ $user->role === 'teacher' ? 'Učitelj' : 'Učenik' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">{{ $user->location ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $user->created_at->format('d.m.Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <form method="POST" action="{{ route('admin.approve-user', $user) }}" class="inline">
                                            @csrf
                                            <button type="submit"
                                                style="background-color: #22c55e; color: white; padding: 4px 12px; border-radius: 4px; border: none; cursor: pointer;">
                                                    ✓Odobri
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.reject-user', $user) }}"
                                            class="inline ml-2">
                                            @csrf
                                            <button type="submit"
                                                style="background-color: #ef4444; color: white; padding: 4px 12px; border-radius: 4px; border: none; cursor: pointer;">
                                                      ✗ Odbij
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>