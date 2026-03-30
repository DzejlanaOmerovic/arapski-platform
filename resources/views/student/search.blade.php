<x-app-layout>
    <x-slot name="header">Pretraži 🌙 يبحث </x-slot>

    @if(session('success'))
        <div class="alert-success">✓ {{ session('success') }}</div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Filter forma --}}
            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <form method="GET" action="{{ route('student.search') }}">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-1">Ključna riječ</label>
                            <input type="text" name="kljucna_rijec" value="{{ request('kljucna_rijec') }}"
                                   placeholder="Naziv kursa..."
                                   class="border rounded w-full px-3 py-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-1">Nivo</label>
                            <select name="nivo" class="border rounded w-full px-3 py-2 text-sm">
                                <option value="">Svi nivoi</option>
                                <option value="pocetni" {{ request('nivo') === 'pocetni' ? 'selected' : '' }}>Početni</option>
                                <option value="srednji" {{ request('nivo') === 'srednji' ? 'selected' : '' }}>Srednji</option>
                                <option value="napredni" {{ request('nivo') === 'napredni' ? 'selected' : '' }}>Napredni</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-1">Tip</label>
                            <select name="tip" class="border rounded w-full px-3 py-2 text-sm">
                                <option value="">Svi tipovi</option>
                                <option value="individualni" {{ request('tip') === 'individualni' ? 'selected' : '' }}>Individualni</option>
                                <option value="grupni" {{ request('tip') === 'grupni' ? 'selected' : '' }}>Grupni</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-1">Max. cijena (KM)</label>
                            <input type="number" name="max_cena" value="{{ request('max_cena') }}"
                                   min="0" class="border rounded w-full px-3 py-2 text-sm">
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit"
                                style="background-color:#4f46e5;color:white;padding:8px 20px;border-radius:6px;border:none;cursor:pointer;">
                            🔍 Pretraži
                        </button>
                        <a href="{{ route('student.search') }}" class="ml-3 text-gray-500 text-sm">Poništi filtere</a>
                    </div>
                </form>
            </div>

            {{-- Rezultati --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($courses as $course)
                <div class="bg-white rounded-lg shadow p-5">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-semibold text-lg">{{ $course->naziv }}</h3>
                        @if($course->is_featured)
                            <span style="background-color:#fef9c3;color:#854d0e;padding:2px 8px;border-radius:4px;font-size:11px;">⭐ Istaknuto</span>
                        @endif
                    </div>
                    <p class="text-gray-500 text-sm mb-3">{{ Str::limit($course->opis, 80) }}</p>
                    <p class="text-sm text-gray-600">👤 {{ $course->teacher->name }}</p>
                    <p class="text-sm text-gray-600">📊 {{ ucfirst($course->nivo) }} • {{ ucfirst($course->tip) }}</p>
                    <p class="text-sm text-gray-600">⏱ {{ $course->trajanje_minuta }} min</p>
                    <div class="flex justify-between items-center mt-4">
                        <span class="font-bold text-blue-600">
                            {{ $course->cena ? $course->cena . ' KM' : 'Besplatno' }}
                        </span>
                        <a href="{{ route('student.course-detail', $course) }}"
                           style="background-color:#4f46e5;color:white;padding:6px 14px;border-radius:6px;font-size:13px;">
                            Detalji →
                        </a>
                    </div>
                </div>
                @empty
                    <div class="col-span-3 text-center text-gray-500 py-12">
                        Nema kurseva koji odgovaraju pretrazi.
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>