<x-app-layout>
    <x-slot name="header"> Moje recenzije 🌙 تقييماتي </x-slot>

    @if(session('success'))
        <div class="alert-success">✓ {{ session('success') }}</div>
    @endif

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- Statistike ocjena --}}
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <div class="flex items-center gap-8">
                    <div class="text-center">
                        <p class="text-5xl font-bold text-yellow-500">
                            {{ $averageRating ? number_format($averageRating, 1) : 'N/A' }}
                        </p>
                        <p class="text-gray-500 mt-1">Prosječna ocjena</p>
                    </div>
                    <div class="flex-1">
                        @for($i = 5; $i >= 1; $i--)
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-sm w-4">{{ $i }}</span>
                            <span class="text-yellow-500 text-sm">★</span>
                            <div class="flex-1 bg-gray-200 rounded h-3">
                                @php
                                    $total = array_sum($ratingStats);
                                    $percent = $total > 0 ? ($ratingStats[$i] / $total) * 100 : 0;
                                @endphp
                                <div class="bg-yellow-400 h-3 rounded"
                                     style="width: {{ $percent }}%"></div>
                            </div>
                            <span class="text-sm text-gray-500 w-6">{{ $ratingStats[$i] }}</span>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>

            {{-- Lista recenzija --}}
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Sve recenzije</h3>
                @forelse($reviews as $review)
                <div class="border-b py-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="font-medium">{{ $review->student->name }}</span>
                            <span class="text-gray-400 text-sm ml-2">
                                {{ $review->created_at->format('d.m.Y') }}
                            </span>
                        </div>
                        <span class="text-yellow-500">
                            {{ str_repeat('★', $review->ocena) }}{{ str_repeat('☆', 5 - $review->ocena) }}
                        </span>
                    </div>
                    <p class="text-gray-600 mt-2">{{ $review->komentar ?? 'Bez komentara' }}</p>
                </div>
                @empty
                    <p class="text-gray-500">Još nema recenzija.</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>