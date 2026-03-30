<x-app-layout>
    <x-slot name="header">Rezervacije 🌙 الحجوزات </x-slot>

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
                @if($reservations->isEmpty())
                    <p class="p-6 text-gray-500">Nemate još nijednu rezervaciju.
                        <a href="{{ route('student.search') }}" class="text-blue-500">Pronađite kurs!</a>
                    </p>
                @else
                <table class="w-full text-left">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3">Kurs</th>
                        <th class="px-6 py-3">Učitelj</th>
                        <th class="px-6 py-3">Datum</th>
                        <th class="px-6 py-3">Cijena</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Recenzija</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $res)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $res->course->naziv ?? 'Privatni čas' }}</td>
                        <td class="px-6 py-4">{{ $res->teacher->name }}</td>
                        <td class="px-6 py-4">{{ $res->datum->format('d.m.Y H:i') }}</td>
                        <td class="px-6 py-4">{{ $res->cena ? $res->cena . ' KM' : 'Besplatno' }}</td>
                        <td class="px-6 py-4">
                            <span style="padding:4px 10px;border-radius:4px;font-size:12px;
                                background-color:{{ $res->status === 'confirmed' ? '#dcfce7' :
                                ($res->status === 'pending' ? '#fef9c3' :
                                ($res->status === 'completed' ? '#dbeafe' : '#fee2e2')) }};
                                color:{{ $res->status === 'confirmed' ? '#16a34a' :
                                ($res->status === 'pending' ? '#ca8a04' :
                                ($res->status === 'completed' ? '#1d4ed8' : '#dc2626')) }}">
                                {{ $res->status === 'confirmed' ? 'Potvrđena' :
                                ($res->status === 'pending' ? 'Na čekanju' :
                                ($res->status === 'completed' ? 'Završena' : 'Odbijena')) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($res->status === 'completed')
                                @if($res->review)
                                    <span class="text-yellow-500 text-sm">
                                        {{ str_repeat('★', $res->review->ocena) }} Ocijenjeno
                                    </span>
                                @else
                                    <button onclick="document.getElementById('review-{{ $res->id }}').classList.toggle('hidden')"
                                            style="background-color:#8b5cf6;color:white;padding:4px 12px;border-radius:4px;border:none;cursor:pointer;font-size:13px;">
                                        Ostavi recenziju
                                    </button>
                                    <div id="review-{{ $res->id }}" class="hidden mt-3 p-3 bg-gray-50 rounded">
                                        <form method="POST" action="{{ route('student.store-review', $res) }}">
                                            @csrf
                                            <div class="mb-2">
                                                <label class="text-sm font-semibold">Ocjena:</label>
                                                <select name="ocena" class="border rounded px-2 py-1 text-sm ml-2">
                                                    <option value="5">★★★★★ (5)</option>
                                                    <option value="4">★★★★☆ (4)</option>
                                                    <option value="3">★★★☆☆ (3)</option>
                                                    <option value="2">★★☆☆☆ (2)</option>
                                                    <option value="1">★☆☆☆☆ (1)</option>
                                                </select>
                                            </div>
                                            <div class="mb-2">
                                                <textarea name="komentar" rows="2" placeholder="Vaš komentar..."
                                                        class="border rounded w-full px-2 py-1 text-sm"></textarea>
                                            </div>
                                            <button type="submit"
                                                    style="background-color:#4f46e5;color:white;padding:4px 12px;border-radius:4px;border:none;cursor:pointer;font-size:13px;">
                                                Pošalji
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @else
                                <span class="text-gray-400 text-sm">—</span>
                            @endif
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