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
                    <p class="p-6 text-gray-500">Nema rezervacija.</p>
                @else
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-3">Učenik</th>
                            <th class="px-6 py-3">Kurs</th>
                            <th class="px-6 py-3">Datum</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Napomena</th>
                            <th class="px-6 py-3">Akcija</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $res)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $res->student->name }}</td>
                            <td class="px-6 py-4">{{ $res->course->naziv ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $res->datum->format('d.m.Y H:i') }}</td>
                            <td class="px-6 py-4">
                                <span style="padding:2px 8px;border-radius:4px;font-size:12px;
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
                            <td class="px-6 py-4 text-sm">{{ $res->napomena ?? '-' }}</td>
                            <td class="px-6 py-4">
                                @if($res->status === 'pending')
                                    <form method="POST" action="{{ route('teacher.approve-reservation', $res) }}" class="inline">
                                        @csrf
                                        <button type="submit" style="background-color:#22c55e;color:white;padding:4px 12px;border-radius:4px;border:none;cursor:pointer;font-size:13px;">
                                            Potvrdi
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('teacher.reject-reservation', $res) }}" class="inline ml-1">
                                        @csrf
                                        <button type="submit" style="background-color:#ef4444;color:white;padding:4px 12px;border-radius:4px;border:none;cursor:pointer;font-size:13px;">
                                            Odbij
                                        </button>
                                    </form>
                                @elseif($res->status === 'confirmed')
                                    <form method="POST" action="{{ route('teacher.complete-reservation', $res) }}">
                                        @csrf
                                        <button type="submit" style="background-color:#3b82f6;color:white;padding:4px 12px;border-radius:4px;border:none;cursor:pointer;font-size:13px;">
                                            Označi završenim
                                        </button>
                                    </form>
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