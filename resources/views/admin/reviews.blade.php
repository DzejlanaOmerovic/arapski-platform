<x-app-layout>
    <x-slot name="header"> Sve recenzije 🌙 جميع التقييمات </x-slot>

    @if(session('success'))
        <div class="alert-success">✓ {{ session('success') }}</div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg overflow-hidden">
                @if($reviews->isEmpty())
                    <p class="p-6 text-gray-500">Još nema recenzija.</p>
                @else
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-3">Učenik</th>
                            <th class="px-6 py-3">Učitelj</th>
                            <th class="px-6 py-3">Ocjena</th>
                            <th class="px-6 py-3">Komentar</th>
                            <th class="px-6 py-3">Datum</th>
                            <th class="px-6 py-3">Akcija</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reviews as $review)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $review->student->name }}</td>
                            <td class="px-6 py-4">{{ $review->teacher->name }}</td>
                            <td class="px-6 py-4 text-yellow-500">
                                {{ str_repeat('★', $review->ocena) }}{{ str_repeat('☆', 5 - $review->ocena) }}
                            </td>
                            <td class="px-6 py-4 text-sm">{{ $review->komentar ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $review->created_at->format('d.m.Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <form method="POST"
                                      action="{{ route('admin.warn-user', $review->student) }}"
                                      onsubmit="return confirm('Poslati upozorenje učeniku?')">
                                    @csrf
                                    <button type="submit"
                                            style="background-color:#f59e0b;color:white;padding:4px 12px;border-radius:4px;border:none;cursor:pointer;font-size:13px;">
                                        Upozori učenika
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-4">{{ $reviews->links() }}</div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>