<x-app-layout>
    <x-slot name="header"> MOJA OBAVEŠTENJA 🌙 إشعاراتي</x-slot>

    @if(session('success'))
        <div class="alert-success">✓ {{ session('success') }}</div>
    @endif

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Forma za novo obavještenje --}}
            <div class="bg-white shadow rounded-lg p-6 mb-8">
                <h3 class="text-lg font-semibold mb-4">Dodaj novo obavještenje</h3>
                <form method="POST" action="{{ route('admin.store-notification') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Naslov *</label>
                        <input type="text" name="naslov" class="border rounded w-full px-3 py-2"
                               placeholder="Naslov obavještenja..." required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Sadržaj *</label>
                        <textarea name="sadrzaj" rows="4" class="border rounded w-full px-3 py-2"
                                  placeholder="Tekst obavještenja..." required></textarea>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Tip *</label>
                        <select name="tip" class="border rounded w-full px-3 py-2">
                            <option value="vijest">📰 Vijest</option>
                            <option value="promocija">🎁 Promocija</option>
                            <option value="dogadjaj">📅 Događaj</option>
                            <option value="upozorenje">⚠️ Upozorenje</option>
                        </select>
                    </div>
                    <button type="submit"
                            style="background-color:#4f46e5;color:white;padding:10px 24px;border-radius:6px;border:none;cursor:pointer;">
                        Objavi obavještenje
                    </button>
                </form>
            </div>

            {{-- Lista obavještenja --}}
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Objavljena obavještenja</h3>
                @forelse($notifications as $n)
                <div class="border-b py-4 flex justify-between items-start">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span style="padding:2px 8px;border-radius:4px;font-size:12px;
                                background-color:{{ $n->tip === 'vijest' ? '#dbeafe' :
                                ($n->tip === 'promocija' ? '#dcfce7' :
                                ($n->tip === 'dogadjaj' ? '#fef9c3' : '#fee2e2')) }};
                                color:{{ $n->tip === 'vijest' ? '#1d4ed8' :
                                ($n->tip === 'promocija' ? '#16a34a' :
                                ($n->tip === 'dogadjaj' ? '#854d0e' : '#dc2626')) }}">
                                {{ ucfirst($n->tip) }}
                            </span>
                            <h4 class="font-semibold">{{ $n->naslov }}</h4>
                        </div>
                        <p class="text-gray-600 text-sm">{{ $n->sadrzaj }}</p>
                        <p class="text-gray-400 text-xs mt-1">{{ $n->created_at->format('d.m.Y H:i') }}</p>
                    </div>
                    <form method="POST" action="{{ route('admin.delete-notification', $n) }}"
                          onsubmit="return confirm('Obrisati ovo obavještenje?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                style="background-color:#ef4444;color:white;padding:4px 12px;border-radius:4px;border:none;cursor:pointer;font-size:13px;">
                            Obriši
                        </button>
                    </form>
                </div>
                @empty
                    <p class="text-gray-500">Još nema obavještenja.</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>