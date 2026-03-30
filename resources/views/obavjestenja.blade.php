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

        /* HERO */
        .page-hero {
            background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
            padding: 0 80px;
            overflow: hidden;
            position: relative;
        }

        .page-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(99,102,241,0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(99,102,241,0.06) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        .page-hero-content {
            max-width: 1000px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            gap: 48px;
            min-height: 300px;
            position: relative;
            z-index: 2;
        }

        .page-hero-left { padding: 48px 0; }

        .hero-tag {
            display: inline-block;
            background: rgba(212,160,23,0.12);
            border: 1px solid rgba(212,160,23,0.3);
            color: #f59e0b;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 5px 16px;
            border-radius: 50px;
            margin-bottom: 16px;
        }

        .page-hero-left h1 {
            color: white;
            font-size: 2.4rem;
            font-weight: 800;
            margin-bottom: 12px;
            line-height: 1.15;
        }

        .page-hero-left h1 span {
            background: linear-gradient(135deg, #f59e0b, #fbbf24);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-hero-left p {
            color: rgba(255,255,255,0.55);
            font-size: 0.9rem;
            line-height: 1.75;
            max-width: 360px;
            margin-bottom: 16px;
        }

        .hero-ar {
            font-size: 1rem;
            color: #f59e0b;
            opacity: 0.6;
            direction: rtl;
            font-weight: 300;
            letter-spacing: 2px;
        }

        .page-hero-right {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 0;
        }

        .hero-art-panel {
            width: 340px;
            height: 220px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-art-circle {
            position: absolute;
            border-radius: 50%;
        }

        .hero-art-circle:nth-child(1) { width: 220px; height: 220px; border: 1px solid rgba(212,160,23,0.12); }
        .hero-art-circle:nth-child(2) { width: 160px; height: 160px; border: 1px solid rgba(99,102,241,0.2); }
        .hero-art-circle:nth-child(3) { width: 100px; height: 100px; background: linear-gradient(135deg, rgba(99,102,241,0.15), rgba(168,85,247,0.15)); border: 1px solid rgba(99,102,241,0.3); }

        .hero-art-text { position: relative; z-index: 2; text-align: center; }

        .hero-art-main {
            font-size: 3.5rem;
            color: rgba(212,160,23,0.9);
            direction: rtl;
            line-height: 1;
            margin-bottom: 8px;
            text-shadow: 0 0 40px rgba(212,160,23,0.3);
        }

        .hero-art-sub {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.3);
            letter-spacing: 0.15em;
            text-transform: uppercase;
        }

        .hero-float-card {
            position: absolute;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            backdrop-filter: blur(10px);
        }

        .hero-float-card:nth-of-type(1) { top: 10px; right: 0; }
        .hero-float-card:nth-of-type(2) { bottom: 10px; left: 0; }
        .float-icon { font-size: 1.2rem; }
        .float-title { font-size: 0.78rem; font-weight: 700; color: white; }
        .float-sub { font-size: 0.68rem; color: rgba(255,255,255,0.4); }

        /* OBAVJEŠTENJA */
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
        <div class="page-hero-content">
            <div class="page-hero-left">
                <div class="hero-tag">📢 Novosti</div>
                <h1>Obavještenja i <span>vijesti</span></h1>
                <p>Pratite najnovije vijesti, promocije i događaje na našoj platformi.</p>
            </div>
            <div class="page-hero-right">
                <div class="hero-art-panel">
                    </div>
                    <div class="hero-float-card">
                        <div class="float-icon">📰</div>
                        <div>
                            <div class="float-title">Najnovije vijesti</div>
                            <div class="float-sub">Uvijek ažurirano</div>
                        </div>
                    </div>
                    <div class="hero-float-card">
                        <div class="float-icon">🎁</div>
                        <div>
                            <div class="float-title">Promocije</div>
                            <div class="float-sub">Posebne ponude</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

    <footer>
        <div>
            <div class="footer-logo-en">🌙 ArapskiLearn</div>
            <div class="footer-logo-ar">أهلا وسهلا بكم</div>
        </div>
        <div class="footer-links">
            <a href="{{ url('/') }}">Početna</a>
            <a href="{{ route('obavjestenja') }}">Obavještenja</a>
            <a href="{{ route('kontakt') }}">Kontakt</a>
            <a href="{{ route('profile.edit') }}">⚙️ Profil</a>

        </div>
        <div class="footer-copy">© 2024 ArapskiLearn</div>
    </footer>

</body>
</html>
