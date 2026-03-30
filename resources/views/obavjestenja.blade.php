<!DOCTYPE html>
<html lang="bs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obavještenja — ArapskiLearn</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background: #f8fafc; padding-top: 64px; }

        .main-nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            padding: 0 48px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
            box-shadow: 0 2px 20px rgba(0,0,0,0.4);
        }
        .nav-logo { text-decoration: none; }
        .nav-logo .logo-en { font-size: 1rem; font-weight: 800; color: white; display: block; }
        .nav-logo .logo-ar { font-size: 0.75rem; color: #f59e0b; direction: rtl; display: block; }
        .nav-links { display: flex; gap: 2px; }
        .nav-links a { color: #a5b4fc; text-decoration: none; padding: 5px 11px; border-radius: 7px; font-size: 0.82rem; font-weight: 500; transition: all 0.2s; }
        .nav-links a:hover { background: rgba(255,255,255,0.12); color: white; }
        .nav-user { display: flex; align-items: center; gap: 8px; }
        .avatar { width: 32px; height: 32px; background: linear-gradient(135deg, #6366f1, #a855f7); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.82rem; color: white; }
        .btn-logout { background: rgba(255,255,255,0.1); color: #a5b4fc; border: 1px solid rgba(255,255,255,0.15); padding: 5px 12px; border-radius: 7px; cursor: pointer; font-size: 0.78rem; font-weight: 500; }
        .btn-nav-login { color: white; text-decoration: none; padding: 7px 16px; border-radius: 8px; font-size: 0.83rem; font-weight: 600; border: 1px solid rgba(255,255,255,0.2); background: rgba(255,255,255,0.08); }
        .btn-nav-register { background: linear-gradient(135deg, #6366f1, #a855f7); color: white; text-decoration: none; padding: 7px 16px; border-radius: 8px; font-size: 0.83rem; font-weight: 700; box-shadow: 0 4px 14px rgba(99,102,241,0.4); }

        .page-hero {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            padding: 48px;
            text-align: center;
        }
        .page-hero h1 { color: white; font-size: 2rem; font-weight: 800; margin-bottom: 8px; }
        .page-hero p { color: rgba(255,255,255,0.7); font-size: 0.95rem; }

        .notif-wrapper { max-width: 800px; margin: 0 auto; padding: 40px 24px; }

        .notif-card {
            background: white;
            border-radius: 14px;
            padding: 22px 24px;
            margin-bottom: 14px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            transition: all 0.2s;
        }
        .notif-card:hover { box-shadow: 0 4px 12px rgba(79,70,229,0.1); border-color: rgba(79,70,229,0.2); }

        .notif-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px; }
        .notif-badge { padding: 3px 10px; border-radius: 20px; font-size: 0.72rem; font-weight: 700; }
        .notif-date { font-size: 0.78rem; color: #94a3b8; }
        .notif-title { font-size: 1rem; font-weight: 700; color: #0f172a; margin-bottom: 6px; }
        .notif-body { font-size: 0.88rem; color: #475569; line-height: 1.65; }

        .empty-state { text-align: center; padding: 60px 24px; color: #94a3b8; }
        .empty-state .icon { font-size: 3rem; margin-bottom: 12px; }

        footer { background: #0f172a; padding: 32px 48px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px; margin-top: 40px; }
        .footer-logo-en { font-size: 1rem; font-weight: 800; color: white; }
        .footer-logo-ar { font-size: 0.75rem; color: #f59e0b; direction: rtl; }
        .footer-links { display: flex; gap: 20px; }
        .footer-links a { color: #475569; text-decoration: none; font-size: 0.82rem; transition: color 0.2s; }
        .footer-links a:hover { color: white; }
        .footer-copy { color: #334155; font-size: 0.75rem; }
    </style>
</head>
<body>

    {{-- NAV --}}
    <nav class="main-nav">
        <a href="{{ url('/') }}" class="nav-logo">
            <span class="logo-en">🌙 ArapskiLearn</span>
            <span class="logo-ar">أهلا وسهلا</span>
        </a>
        <div class="nav-links">
            <a href="{{ url('/') }}">Početna</a>
            <a href="{{ route('obavjestenja') }}">Obavještenja</a>
            <a href="{{ route('kontakt') }}">Kontakt</a>
            @auth
                @if(Auth::user()->role === 'teacher')
                    <a href="{{ route('teacher.dashboard') }}">Panel</a>
                    <a href="{{ route('teacher.courses') }}">Kursevi</a>
                    <a href="{{ route('teacher.reservations') }}">Rezervacije</a>
                @elseif(Auth::user()->role === 'student')
                    <a href="{{ route('student.dashboard') }}">Panel</a>
                    <a href="{{ route('student.search') }}">Pretraži</a>
                    <a href="{{ route('student.reservations') }}">Rezervacije</a>
                @elseif(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}">Panel</a>
                    <a href="{{ route('admin.pending-users') }}">Zahtjevi</a>
                    <a href="{{ route('admin.users') }}">Korisnici</a>
                @endif
            @endauth
        </div>
        <div class="nav-user">
            @auth
                <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                <span style="color:#e2e8f0;font-size:0.82rem;font-weight:500;">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">Odjava</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-nav-login">Prijava</a>
                <a href="{{ route('register') }}" class="btn-nav-register">Registracija →</a>
            @endauth
        </div>
    </nav>

    {{-- HERO --}}
    <div class="page-hero">
        <h1>📢 Obavještenja</h1>
        <p>Vijesti, promocije i događaji</p>
    </div>

    {{-- OBAVJEŠTENJA --}}
    <div class="notif-wrapper">
        @forelse($notifications as $n)
        <div class="notif-card">
            <div class="notif-header">
                <div>
                    <span class="notif-badge" style="
                        background:{{ $n->tip === 'vijest' ? '#dbeafe' : ($n->tip === 'promocija' ? '#dcfce7' : ($n->tip === 'dogadjaj' ? '#fef9c3' : '#fee2e2')) }};
                        color:{{ $n->tip === 'vijest' ? '#1d4ed8' : ($n->tip === 'promocija' ? '#15803d' : ($n->tip === 'dogadjaj' ? '#92400e' : '#dc2626')) }}">
                        {{ $n->tip === 'vijest' ? '📰 Vijest' : ($n->tip === 'promocija' ? '🎁 Promocija' : ($n->tip === 'dogadjaj' ? '📅 Događaj' : '⚠️ Upozorenje')) }}
                    </span>
                </div>
                <span class="notif-date">{{ $n->created_at->format('d.m.Y') }}</span>
            </div>
            <div class="notif-title">{{ $n->naslov }}</div>
            <div class="notif-body">{{ $n->sadrzaj }}</div>
        </div>
        @empty
        <div class="empty-state">
            <div class="icon">📭</div>
            <p>Trenutno nema obavještenja.</p>
        </div>
        @endforelse
    </div>

    {{-- FOOTER --}}
    <footer>
        <div>
            <div class="footer-logo-en">🌙 ArapskiLearn</div>
            <div class="footer-logo-ar">أهلا وسهلا بكم</div>
        </div>
        <div class="footer-links">
            <a href="{{ url('/') }}">Početna</a>
            <a href="{{ route('obavjestenja') }}">Obavještenja</a>
            <a href="{{ route('kontakt') }}">Kontakt</a>
        </div>
        <div class="footer-copy">© 2024 ArapskiLearn</div>
    </footer>

</body>
</html>