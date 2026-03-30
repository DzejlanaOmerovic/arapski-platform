<x-app-layout>
    <x-slot name="header"> Uredi kurseve 🌙 تحرير الدورات </x-slot>

    @if(session('success'))
        <div class="alert-success">✓ {{ session('success') }}</div>
    @endif
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <form method="POST" action="{{ route('teacher.update-course', $course) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Naziv kursa *</label>
                        <input type="text" name="naziv" value="{{ $course->naziv }}"
                               class="border rounded w-full px-3 py-2" required>
                        @error('naziv') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Opis</label>
                        <textarea name="opis" rows="4"
                                  class="border rounded w-full px-3 py-2">{{ $course->opis }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Nivo *</label>
                            <select name="nivo" class="border rounded w-full px-3 py-2">
                                <option value="pocetni" {{ $course->nivo === 'pocetni' ? 'selected' : '' }}>Početni</option>
                                <option value="srednji" {{ $course->nivo === 'srednji' ? 'selected' : '' }}>Srednji</option>
                                <option value="napredni" {{ $course->nivo === 'napredni' ? 'selected' : '' }}>Napredni</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Tip *</label>
                            <select name="tip" class="border rounded w-full px-3 py-2">
                                <option value="individualni" {{ $course->tip === 'individualni' ? 'selected' : '' }}>Individualni</option>
                                <option value="grupni" {{ $course->tip === 'grupni' ? 'selected' : '' }}>Grupni</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Cijena (KM)</label>
                            <input type="number" name="cena" value="{{ $course->cena }}"
                                   min="0" step="0.50" class="border rounded w-full px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Trajanje (minuta) *</label>
                            <input type="number" name="trajanje_minuta" value="{{ $course->trajanje_minuta }}"
                                   min="15" class="border rounded w-full px-3 py-2" required>
                        </div>
                    </div>

                    <button type="submit"
                            style="background-color:#4f46e5;color:white;padding:10px 24px;border-radius:6px;border:none;cursor:pointer;">
                        Sačuvaj izmjene
                    </button>
                    <a href="{{ route('teacher.courses') }}" class="ml-4 text-gray-600">Otkaži</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>