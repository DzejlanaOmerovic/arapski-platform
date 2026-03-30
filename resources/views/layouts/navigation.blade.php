<nav class="main-nav">
    <a href="{{ url('/') }}" class="nav-logo">
        <span class="logo-en">🌙 ArapskiLearn</span>
        <span class="logo-ar">أهلا وسهلا</span>
    </a>

    <div class="nav-links">
        <a href="{{ url('/') }}" {{ request()->is('/') ? 'class=active' : '' }}>Početna</a>
        <a href="{{ route('obavjestenja') }}" {{ request()->routeIs('obavjestenja') ? 'class=active' : '' }}>Obavještenja</a>
        <a href="{{ route('kontakt') }}" {{ request()->routeIs('kontakt') ? 'class=active' : '' }}>Kontakt</a>

        @auth
            @if(Auth::user()->role === 'teacher')
                <a href="{{ route('teacher.dashboard') }}" {{ request()->routeIs('teacher.dashboard') ? 'class=active' : '' }}>Panel</a>
                <a href="{{ route('teacher.courses') }}" {{ request()->routeIs('teacher.courses') ? 'class=active' : '' }}>Kursevi</a>
                <a href="{{ route('teacher.reservations') }}" {{ request()->routeIs('teacher.reservations') ? 'class=active' : '' }}>Rezervacije</a>
                <a href="{{ route('teacher.reviews') }}" {{ request()->routeIs('teacher.reviews') ? 'class=active' : '' }}>Recenzije</a>
                <a href="{{ route('teacher.profile') }}" {{ request()->routeIs('teacher.profile') ? 'class=active' : '' }}>Profil</a>
            @elseif(Auth::user()->role === 'student')
                <a href="{{ route('student.dashboard') }}" {{ request()->routeIs('student.dashboard') ? 'class=active' : '' }}>Panel</a>
                <a href="{{ route('student.search') }}" {{ request()->routeIs('student.search') ? 'class=active' : '' }}>Pretraži</a>
                <a href="{{ route('student.reservations') }}" {{ request()->routeIs('student.reservations') ? 'class=active' : '' }}>Rezervacije</a>
            @elseif(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" {{ request()->routeIs('admin.dashboard') ? 'class=active' : '' }}>Panel</a>
                <a href="{{ route('admin.pending-users') }}" {{ request()->routeIs('admin.pending-users') ? 'class=active' : '' }}>Zahtjevi</a>
                <a href="{{ route('admin.users') }}" {{ request()->routeIs('admin.users') ? 'class=active' : '' }}>Korisnici</a>
                <a href="{{ route('admin.notifications') }}" {{ request()->routeIs('admin.notifications') ? 'class=active' : '' }}>Obavještenja</a>
                <a href="{{ route('admin.settings') }}" {{ request()->routeIs('admin.settings') ? 'class=active' : '' }}>Podešavanja</a>
            @endif
        @endauth
    </div>

    <div class="nav-user">
        @auth
            <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <span class="user-name">{{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">Odjava</button>
            </form>
        @else
            <a href="{{ route('login') }}" style="color:rgba(255,255,255,0.7);text-decoration:none;padding:7px 16px;border-radius:8px;font-size:0.83rem;font-weight:600;border:1px solid rgba(255,255,255,0.15);background:rgba(255,255,255,0.08);transition:all 0.2s;">Prijava</a>
            <a href="{{ route('register') }}" style="background:linear-gradient(135deg,#6366f1,#a855f7);color:white;text-decoration:none;padding:7px 16px;border-radius:8px;font-size:0.83rem;font-weight:700;box-shadow:0 4px 14px rgba(99,102,241,0.4);transition:all 0.2s;">Registracija →</a>
        @endauth
    </div>
</nav>