<x-app-layout>
    <x-slot name="header"> Dobrodošli, {{ Auth::user()->name }}! 🌙 أهلاً</x-slot>

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

            {{-- Statistike --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <p class="text-4xl font-bold text-blue-500">{{ $courses->count() }}</p>
                    <p class="text-gray-600 mt-2">Mojih kurseva</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <p class="text-4xl font-bold text-yellow-500">{{ $pendingReservations }}</p>
                    <p class="text-gray-600 mt-2">Čekaju potvrdu</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <p class="text-4xl font-bold text-green-500">{{ $totalReservations }}</p>
                    <p class="text-gray-600 mt-2">Ukupno rezervacija</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <p class="text-4xl font-bold text-purple-500">
                        {{ $averageRating ? number_format($averageRating, 1) : 'N/A' }}
                    </p>
                    <p class="text-gray-600 mt-2">Prosječna ocjena</p>
                </div>
            </div>

            {{-- Brzi linkovi --}}
            <div class="bg-white p-6 rounded-lg shadow mb-8">
                <h3 class="text-lg font-semibold mb-4">Brzi pristup</h3>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('teacher.create-course') }}"
                       style="background-color:#4f46e5;color:white;padding:8px 16px;border-radius:6px;">
                        + Novi kurs
                    </a>
                    <a href="{{ route('teacher.reservations') }}"
                       style="background-color:#f59e0b;color:white;padding:8px 16px;border-radius:6px;">
                        Rezervacije
                    </a>
                    <a href="{{ route('teacher.reviews') }}"
                       style="background-color:#8b5cf6;color:white;padding:8px 16px;border-radius:6px;">
                        Moje recenzije
                    </a>
                    <a href="{{ route('teacher.profile') }}"
                       style="background-color:#6b7280;color:white;padding:8px 16px;border-radius:6px;">
                        Moj profil
                    </a>
                </div>
            </div>

            {{-- Posljednje recenzije --}}
            @if($recentReviews->isNotEmpty())
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4">Posljednje recenzije</h3>
                @foreach($recentReviews as $review)
                <div class="border-b py-3">
                    <div class="flex justify-between">
                        <span class="font-medium">{{ $review->student->name }}</span>
                        <span class="text-yellow-500">{{ str_repeat('★', $review->ocena) }}{{ str_repeat('☆', 5 - $review->ocena) }}</span>
                    </div>
                    <p class="text-gray-600 text-sm mt-1">{{ $review->komentar ?? 'Bez komentara' }}</p>
                </div>
                @endforeach
            </div>
            @endif

        </div>
    </div>
</x-app-layout>