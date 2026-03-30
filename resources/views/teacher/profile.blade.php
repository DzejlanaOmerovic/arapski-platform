<x-app-layout>
    <x-slot name="header"> Uredi profil 🌙 تعديل الملف الشخصي </x-slot>

    @if(session('success'))
        <div class="alert-success">✓ {{ session('success') }}</div>
    @endif

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg p-6">
                <form method="POST" action="{{ route('teacher.update-profile') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">O meni</label>
                        <textarea name="about" rows="4"
                                  class="border rounded w-full px-3 py-2"
                                  placeholder="Recite nešto o sebi...">{{ $profile->about }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Nivo poznavanja arapskog</label>
                        <input type="text" name="arabic_level" value="{{ $profile->arabic_level }}"
                               placeholder="npr. Izvorni govornik, C2..."
                               class="border rounded w-full px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Cijena po satu (KM)</label>
                        <input type="number" name="price_per_hour" value="{{ $profile->price_per_hour }}"
                               min="0" step="0.50" class="border rounded w-full px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Stil predavanja</label>
                        <input type="text" name="teaching_style" value="{{ $profile->teaching_style }}"
                               placeholder="npr. Konverzacijski, akademski..."
                               class="border rounded w-full px-3 py-2">
                    </div>

                    <div class="mb-6 flex gap-6">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="offers_individual" value="1"
                                   {{ $profile->offers_individual ? 'checked' : '' }}>
                            <span>Nudim individualne časove</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="offers_group" value="1"
                                   {{ $profile->offers_group ? 'checked' : '' }}>
                            <span>Nudim grupne časove</span>
                        </label>
                    </div>

                    <button type="submit"
                            style="background-color:#4f46e5;color:white;padding:10px 24px;border-radius:6px;border:none;cursor:pointer;">
                        Sačuvaj profil
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>