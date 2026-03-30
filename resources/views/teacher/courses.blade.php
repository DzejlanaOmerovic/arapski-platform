<x-app-layout>
    <x-slot name="header"> Moji kursevi 🌙 دوراتي </x-slot>

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

            <div class="mb-4">
                <a href="{{ route('teacher.create-course') }}"
                   style="background-color:#4f46e5;color:white;padding:8px 16px;border-radius:6px;">
                    + Dodaj novi kurs
                </a>
            </div>

            <div class="bg-white shadow rounded-lg overflow-hidden">
                @if($courses->isEmpty())
                    <p class="p-6 text-gray-500">Nemate još nijedan kurs. Dodajte prvi!</p>
                @else
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-3">Naziv</th>
                            <th class="px-6 py-3">Nivo</th>
                            <th class="px-6 py-3">Tip</th>
                            <th class="px-6 py-3">Cijena</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Akcija</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $course->naziv }}</td>
                            <td class="px-6 py-4">{{ ucfirst($course->nivo) }}</td>
                            <td class="px-6 py-4">{{ ucfirst($course->tip) }}</td>
                            <td class="px-6 py-4">{{ $course->cena ? $course->cena . ' KM' : 'Besplatno' }}</td>
                            <td class="px-6 py-4">
                                <span style="padding:2px 8px;border-radius:4px;font-size:12px;
                                    background-color:{{ $course->is_active ? '#dcfce7' : '#fee2e2' }};
                                    color:{{ $course->is_active ? '#16a34a' : '#dc2626' }}">
                                    {{ $course->is_active ? 'Aktivan' : 'Neaktivan' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 flex gap-2">
                                <a href="{{ route('teacher.edit-course', $course) }}"
                                   style="background-color:#f59e0b;color:white;padding:4px 12px;border-radius:4px;font-size:14px;">
                                    Uredi
                                </a>
                                <form method="POST" action="{{ route('teacher.delete-course', $course) }}"
                                      onsubmit="return confirm('Sigurno želiš obrisati ovaj kurs?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            style="background-color:#ef4444;color:white;padding:4px 12px;border-radius:4px;font-size:14px;border:none;cursor:pointer;">
                                        Obriši
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