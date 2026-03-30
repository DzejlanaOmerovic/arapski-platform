<x-app-layout>
    <x-slot name="header"> Podešavanja sistema 🌙 إعدادات النظام </x-slot>

    @if(session('success'))
        <div class="alert-success">✓ {{ session('success') }}</div>
    @endif

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg p-6">
                <form method="POST" action="{{ route('admin.update-settings') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">
                            Broj zapamćenih lozinki
                        </label>
                        <input type="number" name="password_history_count" 
                               value="{{ $passwordHistoryCount }}" min="1" max="10"
                               class="border rounded w-full px-3 py-2">
                        <p class="text-sm text-gray-500 mt-1">
                            Korisnik ne može koristiti poslednjih N lozinki
                        </p>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">
                            Maksimalan broj upozorenja
                        </label>
                        <input type="number" name="max_warnings" 
                               value="{{ $maxWarnings }}" min="1" max="10"
                               class="border rounded w-full px-3 py-2">
                        <p class="text-sm text-gray-500 mt-1">
                            Nakon ovog broja korisnik se automatski blokira
                        </p>
                    </div>

                    <button type="submit" 
                            class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                        Sačuvaj podešavanja
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>