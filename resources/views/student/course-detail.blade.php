<x-app-layout>
    <x-slot name="header"> Moji kursevi 🌙 دوراتي </x-slot>

    @if(session('success'))
        <div class="alert-success">✓ {{ session('success') }}</div>
    @endif
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Detalji kursa --}}
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-gray-500 text-sm">Učitelj</p>
                        <p class="font-semibold">{{ $course->teacher->name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Prosječna ocjena</p>
                        <p class="font-semibold text-yellow-500">
                            {{ $averageRating ? '★ ' . number_format($averageRating, 1) . '/5' : 'Još nema ocjena' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Nivo</p>
                        <p class="font-semibold">{{ ucfirst($course->nivo) }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Tip</p>
                        <p class="font-semibold">{{ ucfirst($course->tip) }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Trajanje</p>
                        <p class="font-semibold">{{ $course->trajanje_minuta }} minuta</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Cijena</p>
                        <p class="font-semibold text-blue-600">
                            {{ $course->cena ? $course->cena . ' KM' : 'Besplatno' }}
                        </p>
                    </div>
                </div>
                @if($course->opis)
                <div class="mt-4 border-t pt-4">
                    <p class="text-gray-700">{{ $course->opis }}</p>
                </div>
                @endif
            </div>

            {{-- Forma za rezervaciju --}}
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold mb-4">📅 Rezerviši čas</h3>
                <form method="POST" action="{{ route('student.reserve', $course) }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Datum i vrijeme *</label>
                        <input type="datetime-local" name="datum"
                               class="border rounded w-full px-3 py-2"
                               min="{{ now()->addHour()->format('Y-m-d\TH:i') }}" required>
                        @error('datum') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Napomena</label>
                        <textarea name="napomena" rows="3"
                                  placeholder="Npr. preferiram jutarnje termine..."
                                  class="border rounded w-full px-3 py-2"></textarea>
                    </div>
                    <button type="submit"
                            style="background-color:#4f46e5;color:white;padding:10px 24px;border-radius:6px;border:none;cursor:pointer;">
                        Pošalji zahtjev za rezervaciju
                    </button>
                </form>
            </div>

            {{-- Recenzije --}}
            @if($reviews->isNotEmpty())
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">💬 Recenzije učenika</h3>
                @foreach($reviews as $review)
                <div class="border-b py-3">
                    <div class="flex justify-between">
                        <span class="font-medium">{{ $review->student->name }}</span>
                        <span class="text-yellow-500">{{ str_repeat('★', $review->ocena) }}{{ str_repeat('☆', 5 - $review->ocena) }}</span>
                    </div>
                    <p class="text-gray-600 text-sm mt-1">{{ $review->komentar ?? 'Bez komentara' }}</p>
                    <p class="text-gray-400 text-xs mt-1">{{ $review->created_at->format('d.m.Y') }}</p>
                </div>
                @endforeach
            </div>
            @endif

        </div>
    </div>
</x-app-layout>