<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" id="registerForm">
        @csrf

        <!-- Ime -->
        <div>
            <x-input-label for="name" :value="__('Ime i prezime')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" 
                name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email adresa')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" 
                name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Uloga -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Registrujem se kao')" />
            <select id="role" name="role" 
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                <option value="student">Učenik — želim učiti arapski</option>
                <option value="teacher">Učitelj — nudim nastavu arapskog</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Telefon -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Broj telefona')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" 
                name="phone" :value="old('phone')" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Lokacija -->
        <div class="mt-4">
            <x-input-label for="location" :value="__('Grad / Lokacija')" />
            <x-text-input id="location" class="block mt-1 w-full" type="text" 
                name="location" :value="old('location')" />
            <x-input-error :messages="$errors->get('location')" class="mt-2" />
        </div>

        <!-- Lozinka -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Lozinka')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" 
                name="password" required />
            <p class="text-xs text-gray-500 mt-1">
                Min. 8 karaktera, veliko slovo, broj i specijalni znak (@$!%*?&)
            </p>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Potvrda lozinke -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Potvrdi lozinku')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" 
                type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Dugmad -->
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" 
                href="{{ route('login') }}">
                Već imam nalog
            </a>
            <x-primary-button class="ms-4">
                Pošalji zahtjev za registraciju
            </x-primary-button>
        </div>
    </form>

    <!-- JavaScript validacija -->
    <script>
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        let valid = true;
        const password = document.getElementById('password').value;
        const email = document.getElementById('email').value;
        const name = document.getElementById('name').value;

        // Ime validacija
        if (name.trim().length < 3) {
            alert('Ime mora imati najmanje 3 karaktera!');
            valid = false;
        }

        // Email validacija
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            alert('Unesite ispravnu email adresu!');
            valid = false;
        }

        // Lozinka validacija
        if (!/^(?=.*[A-Z])(?=.*[0-9])(?=.*[@$!%*?&]).{8,}$/.test(password)) {
            alert('Lozinka mora imati najmanje 8 karaktera, jedno veliko slovo, jedan broj i jedan specijalni znak (@$!%*?&)!');
            valid = false;
        }

        if (!valid) e.preventDefault();
    });
    </script>
</x-guest-layout>