<!DOCTYPE html>
<html lang="bs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakt — ArapskiLearn</title>
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
        .btn-logout { background: rgba(255,255,255,0.1); color: #a5b4fc; border: 1px solid rgba(255,255,255,0.15); padding: 5px 12px; border-radius: 7px; cursor: pointer; font-size: 0.78rem; font-weight: 500; transition: all 0.2s; }
        .btn-nav-login { color: white; text-decoration: none; padding: 7px 16px; border-radius: 8px; font-size: 0.83rem; font-weight: 600; border: 1px solid rgba(255,255,255,0.2); background: rgba(255,255,255,0.08); transition: all 0.2s; }
        .btn-nav-register { background: linear-gradient(135deg, #6366f1, #a855f7); color: white; text-decoration: none; padding: 7px 16px; border-radius: 8px; font-size: 0.83rem; font-weight: 700; box-shadow: 0 4px 14px rgba(99,102,241,0.4); transition: all 0.2s; }

        .page-hero {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            padding: 48px 48px;
            text-align: center;
        }
        .page-hero h1 { color: white; font-size: 2rem; font-weight: 800; margin-bottom: 8px; }
        .page-hero p { color: rgba(255,255,255,0.7); font-size: 0.95rem; }

        .kontakt-wrapper { max-width: 1000px; margin: 0 auto; padding: 48px 24px; display: grid; grid-template-columns: 1fr 1fr; gap: 32px; }

        .info-card { background: white; border-radius: 14px; padding: 20px; margin-bottom: 14px; display: flex; align-items: flex-start; gap: 14px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); border: 1px solid #e2e8f0; }
        .info-icon { font-size: 1.6rem; flex-shrink: 0; }
        .info-title { font-size: 0.88rem; font-weight: 700; color: #0f172a; margin-bottom: 3px; }
        .info-text { font-size: 0.83rem; color: #475569; }
        .info-sub { font-size: 0.75rem; color: #94a3b8; margin-top: 2px; }

        .form-card { background: white; border-radius: 14px; padding: 28px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); border: 1px solid #e2e8f0; }
        .form-title { font-size: 1.1rem; font-weight: 800; color: #0f172a; margin-bottom: 20px; }
        .form-group { margin-bottom: 16px; }
        .form-label { display: block; font-size: 0.82rem; font-weight: 600; color: #374151; margin-bottom: 5px; }
        .form-control { width: 100%; padding: 9px 13px; border: 1.5px solid #e5e7eb; border-radius: 9px; font-size: 0.88rem; transition: all 0.2s; background: white; color: #1e293b; }
        .form-control:focus { outline: none; border-color: #4f46e5; box-shadow: 0 0 0 3px rgba(79,70,229,0.1); }
        .form-error { color: #dc2626; font-size: 0.75rem; margin-top: 4px; display: none; }
        .btn-submit { width: 100%; background: linear-gradient(135deg, #4f46e5, #7c3aed); color: white; padding: 11px; border-radius: 10px; border: none; cursor: pointer; font-size: 0.9rem; font-weight: 700; transition: all 0.2s; box-shadow: 0 4px 14px rgba(79,70,229,0.3); }
        .btn-submit:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(79,70,229,0.4); }
        .alert-success { background: #f0fdf4; border-left: 3px solid #22c55e; color: #15803d; padding: 12px 16px; border-radius: 9px; margin-bottom: 16px; font-size: 0.85rem; font-weight: 500; display: none; }

        footer { background: #0f172a; padding: 32px 48px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px; }
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
        <h1>📬 Kontaktirajte nas</h1>
        <p>Tu smo za sva vaša pitanja i prijedloge</p>
    </div>

    {{-- SADRŽAJ --}}
    <div class="kontakt-wrapper">
        <div>
            <div style="font-size:0.82rem;font-weight:700;color:#4f46e5;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:16px;">Informacije</div>
            <div class="info-card">
                <div class="info-icon">📧</div>
                <div>
                    <div class="info-title">Email</div>
                    <div class="info-text">info@arapskilearn.ba</div>
                    <div class="info-sub">Odgovaramo u roku od 24 sata</div>
                </div>
            </div>
            <div class="info-card">
                <div class="info-icon">📞</div>
                <div>
                    <div class="info-title">Telefon</div>
                    <div class="info-text">+387 61 234 567</div>
                    <div class="info-sub">Pon — Pet: 9:00 — 17:00</div>
                </div>
            </div>
            <div class="info-card">
                <div class="info-icon">📍</div>
                <div>
                    <div class="info-title">Lokacija</div>
                    <div class="info-text">Bosna i Hercegovina</div>
                    <div class="info-sub">Online platforma — dostupna svima</div>
                </div>
            </div>
            <div class="info-card">
                <div class="info-icon">🕐</div>
                <div>
                    <div class="info-title">Radno vrijeme</div>
                    <div class="info-text">Pon — Pet: 9:00 — 17:00</div>
                    <div class="info-text">Subota: 10:00 — 14:00</div>
                    <div class="info-sub">Nedjelja: zatvoreno</div>
                </div>
            </div>
        </div>

        <div>
            <div class="form-card">
                <div class="form-title">Pošalji poruku ✉️</div>
                <div class="alert-success" id="uspjeh">✓ Poruka je uspješno poslana! Kontaktiraćemo vas uskoro.</div>
                <form id="kontaktForm">
                    <div class="form-group">
                        <label class="form-label">Ime i prezime *</label>
                        <input type="text" id="ime" class="form-control" placeholder="Vaše ime...">
                        <div class="form-error" id="ime-error">Unesite vaše ime!</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email *</label>
                        <input type="email" id="email" class="form-control" placeholder="vas@email.com">
                        <div class="form-error" id="email-error">Unesite ispravnu email adresu!</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tema *</label>
                        <select id="tema" class="form-control">
                            <option value="">Odaberite temu...</option>
                            <option value="pitanje">Opšte pitanje</option>
                            <option value="tehnicka">Tehnička podrška</option>
                            <option value="ucitelj">Postati učitelj</option>
                            <option value="reklamacija">Reklamacija</option>
                            <option value="ostalo">Ostalo</option>
                        </select>
                        <div class="form-error" id="tema-error">Odaberite temu!</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Poruka *</label>
                        <textarea id="poruka" rows="5" class="form-control" placeholder="Vaša poruka..."></textarea>
                        <div class="form-error" id="poruka-error">Unesite poruku (min. 10 karaktera)!</div>
                    </div>
                    <button type="submit" class="btn-submit">Pošalji poruku →</button>
                </form>
            </div>
        </div>
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

    <script>
    document.getElementById('kontaktForm').addEventListener('submit', function(e) {
        e.preventDefault();
        let valid = true;
        const ime = document.getElementById('ime').value.trim();
        const email = document.getElementById('email').value.trim();
        const tema = document.getElementById('tema').value;
        const poruka = document.getElementById('poruka').value.trim();

        document.querySelectorAll('.form-error').forEach(el => el.style.display = 'none');

        if (ime.length < 3) { document.getElementById('ime-error').style.display = 'block'; valid = false; }
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { document.getElementById('email-error').style.display = 'block'; valid = false; }
        if (!tema) { document.getElementById('tema-error').style.display = 'block'; valid = false; }
        if (poruka.length < 10) { document.getElementById('poruka-error').style.display = 'block'; valid = false; }

        if (valid) {
            document.getElementById('uspjeh').style.display = 'block';
            document.getElementById('kontaktForm').reset();
        }
    });
    </script>
</body>
</html>