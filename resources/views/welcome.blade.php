<!DOCTYPE html>
<html lang="bs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArapskiLearn — Nauči arapski jezik</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        :root {
            --indigo: #4f46e5;
            --indigo-dark: #3730a3;
            --indigo-light: #6366f1;
            --gold: #d97706;
            --gold-light: #f59e0b;
            --bg: #f8fafc;
            --bg-2: #f1f5f9;
            --text: #0f172a;
            --text-dim: #475569;
            --text-muted: #94a3b8;
            --border: #e2e8f0;
        }

        body {
            background: var(--bg);
            color: var(--text);
            overflow-x: hidden;
        }

        /* NAV */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 0 48px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(10, 15, 30, 0.92);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(212, 160, 23, 0.15);
        }

        .nav-logo {
            text-decoration: none;
        }

        .nav-logo .en {
            font-size: 1.05rem;
            font-weight: 800;
            color: white;
            display: block;
        }

        .nav-logo .ar {
            font-size: 0.75rem;
            color: var(--gold);
            direction: rtl;
            display: block;
        }

        .nav-center {
            display: flex;
            gap: 4px;
        }

        .nav-center a {
            color: var(--text-dim);
            text-decoration: none;
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 0.83rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .nav-center a {
            color: #94a3b8;
        }

        .nav-right {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .btn-nav-login {
            color: white;
            text-decoration: none;
            padding: 8px 20px;
            border-radius: 9px;
            font-size: 0.83rem;
            font-weight: 700;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.2s;
        }

        .btn-nav-login:hover {
            background: rgba(255, 255, 255, 0.18);
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.2);
        }

        .btn-nav-register {
            background: linear-gradient(135deg, #6366f1, #a855f7);
            color: white;
            text-decoration: none;
            padding: 8px 20px;
            border-radius: 9px;
            font-size: 0.83rem;
            font-weight: 700;
            transition: all 0.2s;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
            border: 1px solid transparent;
        }

        .btn-nav-register:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 22px rgba(99, 102, 241, 0.55);
        }

        .btn-nav-register {
            background: linear-gradient(135deg, var(--indigo), var(--indigo-light));
            color: white;
            text-decoration: none;
            padding: 8px 20px;
            border-radius: 9px;
            font-size: 0.83rem;
            font-weight: 700;
            transition: all 0.2s;
            box-shadow: 0 4px 14px rgba(79, 70, 229, 0.3);
        }

        .btn-nav-register:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
        }

        /* HERO */
        .hero {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            padding: 100px 80px 60px;
            gap: 60px;
            background: linear-gradient(135deg, #fafbff 0%, #f0f4ff 50%, #faf5ff 100%);
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.12) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -100px;
            left: -50px;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(217, 119, 6, 0.08) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero-left {
            position: relative;
            z-index: 2;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(79, 70, 229, 0.08);
            border: 1px solid rgba(79, 70, 229, 0.2);
            border-radius: 50px;
            padding: 6px 16px;
            font-size: 0.73rem;
            font-weight: 700;
            color: var(--indigo);
            margin-bottom: 20px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .hero-title {
            font-size: clamp(2rem, 3.5vw, 3rem);
            font-weight: 900;
            line-height: 1.15;
            color: var(--text);
            margin-bottom: 16px;
        }

        .hero-title span {
            background: linear-gradient(135deg, var(--indigo), #a855f7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-ar-title {
            font-size: 1.1rem;
            color: var(--gold);
            direction: rtl;
            margin-bottom: 16px;
            font-weight: 500;
        }

        .hero-sub {
            font-size: 0.95rem;
            color: var(--text-dim);
            line-height: 1.75;
            margin-bottom: 32px;
            max-width: 440px;
        }

        .hero-buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 40px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--indigo), var(--indigo-light));
            color: white;
            text-decoration: none;
            padding: 13px 28px;
            border-radius: 11px;
            font-size: 0.88rem;
            font-weight: 700;
            transition: all 0.3s;
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.35);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(79, 70, 229, 0.45);
        }

        .btn-secondary {
            background: white;
            color: var(--indigo);
            text-decoration: none;
            padding: 13px 28px;
            border-radius: 11px;
            font-size: 0.88rem;
            font-weight: 600;
            border: 1.5px solid var(--border);
            transition: all 0.3s;
        }

        .btn-secondary:hover {
            border-color: var(--indigo);
            background: rgba(79, 70, 229, 0.04);
        }

        .hero-stats {
            display: flex;
            gap: 28px;
            padding-top: 24px;
            border-top: 1px solid var(--border);
        }

        .hero-stat-num {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--indigo);
        }

        .hero-stat-lbl {
            font-size: 0.73rem;
            color: var(--text-muted);
            margin-top: 2px;
        }

        /* HERO SLIKA */
        .hero-right {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero-image-wrapper {
            position: relative;
            width: 100%;
            max-width: 480px;
        }

        .hero-image-wrapper img {
            width: 100%;
            height: 420px;
            object-fit: cover;
            border-radius: 24px;
            box-shadow: 0 24px 60px rgba(79, 70, 229, 0.2);
        }

        .hero-image-card {
            position: absolute;
            background: white;
            border-radius: 14px;
            padding: 14px 18px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .hero-image-card.card-1 {
            bottom: -20px;
            left: -20px;
        }

        .hero-image-card.card-2 {
            top: -16px;
            right: -16px;
        }

        .card-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .card-title {
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--text);
        }

        .card-sub {
            font-size: 0.72rem;
            color: var(--text-muted);
        }

        .hero-ar-deco {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 8rem;
            color: rgba(79, 70, 229, 0.04);
            direction: rtl;
            pointer-events: none;
            white-space: nowrap;
        }

        /* STATS BAR */
        .stats-bar {
            background: white;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            padding: 28px 48px;
            display: flex;
            justify-content: center;
            gap: 60px;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
        }

        .stat-num {
            font-size: 1.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--indigo), #a855f7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-lbl {
            font-size: 0.73rem;
            color: var(--text-muted);
            margin-top: 3px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        /* SEKCIJE */
        section {
            padding: 72px 80px;
        }

        .section-tag {
            display: inline-block;
            background: rgba(79, 70, 229, 0.08);
            border: 1px solid rgba(79, 70, 229, 0.18);
            color: var(--indigo);
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            padding: 5px 14px;
            border-radius: 50px;
            margin-bottom: 12px;
        }

        .section-title {
            font-size: clamp(1.5rem, 2.5vw, 2rem);
            font-weight: 800;
            color: var(--text);
            margin-bottom: 10px;
        }

        .section-title span {
            background: linear-gradient(135deg, var(--indigo), #a855f7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-sub {
            color: var(--text-dim);
            font-size: 0.92rem;
            line-height: 1.75;
            max-width: 480px;
        }

        /* KORACI */
        .steps-section {
            max-width: 1100px;
            margin: 0 auto;
        }

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 18px;
            margin-top: 40px;
        }

        .step-card {
            background: white;
            border: 1.5px solid var(--border);
            border-radius: 16px;
            padding: 26px;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .step-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(135deg, var(--indigo), #a855f7);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .step-card:hover {
            border-color: rgba(79, 70, 229, 0.25);
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(79, 70, 229, 0.1);
        }

        .step-card:hover::before {
            opacity: 1;
        }

        .step-num {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--indigo), var(--indigo-light));
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 0.82rem;
            color: white;
            margin-bottom: 14px;
        }

        .step-icon {
            font-size: 1.4rem;
            margin-bottom: 10px;
        }

        .step-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 8px;
        }

        .step-desc {
            font-size: 0.82rem;
            color: var(--text-dim);
            line-height: 1.65;
        }

        /* KURSEVI */
        .courses-section {
            max-width: 1100px;
            margin: 0 auto;
        }

        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 18px;
            margin-top: 40px;
        }

        .course-card {
            background: white;
            border: 1.5px solid var(--border);
            border-radius: 16px;
            padding: 26px;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .course-card:hover {
            border-color: rgba(79, 70, 229, 0.25);
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(79, 70, 229, 0.1);
        }

        .course-ar {
            position: absolute;
            top: 16px;
            right: 16px;
            font-size: 1.6rem;
            color: rgba(79, 70, 229, 0.07);
            direction: rtl;
        }

        .course-level {
            display: inline-block;
            padding: 3px 11px;
            border-radius: 50px;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .level-pocetni {
            background: #dcfce7;
            color: #15803d;
        }

        .level-srednji {
            background: #fef3c7;
            color: #92400e;
        }

        .level-napredni {
            background: #fee2e2;
            color: #dc2626;
        }

        .course-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 8px;
        }

        .course-desc {
            font-size: 0.82rem;
            color: var(--text-dim);
            line-height: 1.65;
            margin-bottom: 18px;
        }

        .course-price {
            font-size: 1rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--indigo), #a855f7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* CTA */
        .cta-section {
            max-width: 1100px;
            margin: 0 auto;
        }

        .cta-box {
            background: linear-gradient(135deg, var(--indigo) 0%, #6366f1 50%, #a855f7 100%);
            border-radius: 24px;
            padding: 56px 64px;
            display: grid;
            grid-template-columns: 1fr auto;
            align-items: center;
            gap: 40px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(79, 70, 229, 0.35);
        }

        .cta-box::before {
            content: 'تعلم العربية';
            position: absolute;
            bottom: -20px;
            right: 40px;
            font-size: 5rem;
            color: rgba(255, 255, 255, 0.05);
            direction: rtl;
            pointer-events: none;
            font-weight: 700;
        }

        .cta-title {
            font-size: 1.6rem;
            font-weight: 800;
            color: white;
            margin-bottom: 8px;
        }

        .cta-sub {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
            line-height: 1.65;
        }

        .btn-cta {
            background: white;
            color: var(--indigo);
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 12px;
            font-size: 0.88rem;
            font-weight: 700;
            white-space: nowrap;
            transition: all 0.2s;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
        }

        .btn-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        /* FOOTER */
        footer {
            background: var(--text);
            padding: 40px 80px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }

        .footer-left .en {
            font-size: 1rem;
            font-weight: 800;
            color: white;
        }

        .footer-left .ar {
            font-size: 0.78rem;
            color: var(--gold-light);
            direction: rtl;
            margin-top: 2px;
        }

        .footer-links {
            display: flex;
            gap: 20px;
        }

        .footer-links a {
            color: #64748b;
            text-decoration: none;
            font-size: 0.82rem;
            font-weight: 500;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: white;
        }

        .footer-copy {
            color: #334155;
            font-size: 0.75rem;
        }
    </style>
</head>

<body>
    <nav>
        <a href="{{ url('/') }}" class="nav-logo">
            <span class="en">🌙 ArapskiLearn</span>
            <span class="ar">أهلا وسهلا</span>
        </a>
        <div class="nav-center">
            <a href="#kursevi">Početna</a>
            <a href="{{ route('obavjestenja') }}">Obavještenja</a>
            <a href="{{ route('kontakt') }}">Kontakt</a>
        </div>
        <div class="nav-right">
            @auth
                <div style="display:flex;align-items:center;gap:8px;">
                    <div
                        style="width:32px;height:32px;background:linear-gradient(135deg,#6366f1,#a855f7);border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.82rem;color:white;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span style="color:white;font-size:0.83rem;font-weight:500;">{{ Auth::user()->name }}</span>
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn-nav-register">Panel →</a>
                    @elseif(Auth::user()->role === 'teacher')
                        <a href="{{ route('teacher.dashboard') }}" class="btn-nav-register">Panel →</a>
                    @else
                        <a href="{{ route('student.dashboard') }}" class="btn-nav-register">Panel →</a>
                    @endif
                </div>
            @else
                <a href="{{ route('login') }}" class="btn-nav-login">Prijava</a>
                <a href="{{ route('register') }}" class="btn-nav-register">Registracija →</a>
            @endauth
        </div>
    </nav>

    {{-- HERO --}}
    <section class="hero">
        <div class="hero-left">
            <div class="hero-badge">🌙 Platforma za učenje arapskog</div>
            <div class="hero-ar-title">أهلاً بك في عالم اللغة العربية</div>
            <h1 class="hero-title">Nauči arapski jezik sa <span>najboljim učiteljima</span></h1>
            <p class="hero-sub">Poveži se sa iskusnim učiteljima arapskog. Individualni i grupni časovi prilagođeni tvom
                nivou, rasporedu i ciljevima.</p>
            <div class="hero-buttons">
                <a href="{{ route('register') }}" class="btn-primary">Počni učiti besplatno →</a>
                <a href="#kursevi" class="btn-secondary">Pregledaj kurseve</a>
            </div>
            <div class="hero-stats">
                <div>
                    <div class="hero-stat-num">100+</div>
                    <div class="hero-stat-lbl">Učenika</div>
                </div>
                <div>
                    <div class="hero-stat-num">50+</div>
                    <div class="hero-stat-lbl">Učitelja</div>
                </div>
                <div>
                    <div class="hero-stat-num">4.9★</div>
                    <div class="hero-stat-lbl">Ocjena</div>
                </div>
            </div>
        </div>
        <div class="hero-right">
            <div class="hero-image-wrapper">
                <div class="hero-ar-deco">عربي</div>
                <img src="https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=800&q=80"
                    alt="Učenje arapskog jezika"
                    onerror="this.src='https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=800&q=80'">
                <div class="hero-image-card card-1">
                    <div class="card-icon" style="background:#ede9fe;">📚</div>
                    <div>
                        <div class="card-title">500+ časova</div>
                        <div class="card-sub">Održano do sada</div>
                    </div>
                </div>
                <div class="hero-image-card card-2">
                    <div class="card-icon" style="background:#dcfce7;">⭐</div>
                    <div>
                        <div class="card-title">Ocjena 4.9/5</div>
                        <div class="card-sub">Prosječna ocjena</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- STATS --}}
    <div class="stats-bar">
        <div class="stat-item">
            <div class="stat-num">100+</div>
            <div class="stat-lbl">Registrovanih učenika</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">50+</div>
            <div class="stat-lbl">Iskusnih učitelja</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">500+</div>
            <div class="stat-lbl">Održanih časova</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">4.9★</div>
            <div class="stat-lbl">Prosječna ocjena</div>
        </div>
    </div>

    {{-- KORACI --}}
    <section id="koraci" style="background: var(--bg-2);">
        <div class="steps-section">
            <div class="section-tag">Kako funkcioniše</div>
            <h2 class="section-title">Tri koraka do <span>prvog časa</span></h2>
            <p class="section-sub">Jednostavan proces koji te vodi od registracije do učenja za samo nekoliko minuta.
            </p>
            <div class="steps-grid">
                <div class="step-card">
                    <div class="step-num">01</div>
                    <div class="step-icon">📝</div>
                    <div class="step-title">Registruj se</div>
                    <div class="step-desc">Kreiraj nalog kao učenik ili učitelj. Administrator odobrava registraciju
                        radi sigurnosti platforme.</div>
                </div>
                <div class="step-card">
                    <div class="step-num">02</div>
                    <div class="step-icon">🔍</div>
                    <div class="step-title">Pronađi učitelja</div>
                    <div class="step-desc">Pretražuj učitelje po nivou znanja, cijeni, tipu nastave i ocjenama drugih
                        učenika.</div>
                </div>
                <div class="step-card">
                    <div class="step-num">03</div>
                    <div class="step-icon">🎓</div>
                    <div class="step-title">Uči i napreduj</div>
                    <div class="step-desc">Rezerviši čas, pohađaj nastavu i ostavi recenziju. Prati svoj napredak kroz
                        platformu.</div>
                </div>
            </div>
        </div>
    </section>

    {{-- KURSEVI --}}
    <section id="kursevi" style="background: white;">
        <div class="courses-section">
            <div class="section-tag">Naši kursevi</div>
            <h2 class="section-title">Kursevi za <span>svaki nivo</span></h2>
            <p class="section-sub">Od potpunih početnika do naprednih govornika — imamo kurs za tebe.</p>
            <div class="courses-grid">
                <div class="course-card">
                    <div class="course-ar">ألف</div>
                    <span class="course-level level-pocetni">Početni</span>
                    <div class="course-title">Osnove arapskog pisma</div>
                    <div class="course-desc">Naučite arapsko pismo, harfove i osnove izgovora od samog početka. Idealno
                        za početnike.</div>
                    <div class="course-price">od 20 KM / čas</div>
                </div>
                <div class="course-card">
                    <div class="course-ar">باء</div>
                    <span class="course-level level-srednji">Srednji</span>
                    <div class="course-title">Svakodnevni razgovor</div>
                    <div class="course-desc">Konverzacijski arapski za svakodnevne situacije. Proširite vokabular i
                        poboljšajte izgovor.</div>
                    <div class="course-price">od 25 KM / čas</div>
                </div>
                <div class="course-card">
                    <div class="course-ar">تاء</div>
                    <span class="course-level level-napredni">Napredni</span>
                    <div class="course-title">Klasični arapski (Fusha)</div>
                    <div class="course-desc">Fusha — standardni književni arapski koji se koristi u medijima, literaturi
                        i vjeri.</div>
                    <div class="course-price">od 30 KM / čas</div>
                </div>
            </div>
            <div style="margin-top: 32px; text-align: center;">
                <a href="{{ route('register') }}" class="btn-primary">Vidi sve kurseve →</a>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section style="background: var(--bg-2);">
        <div class="cta-section">
            <div class="cta-box">
                <div>
                    <div
                        style="display:inline-block;background:rgba(255,255,255,0.15);border-radius:50px;padding:4px 14px;font-size:0.68rem;font-weight:700;color:white;letter-spacing:0.1em;text-transform:uppercase;margin-bottom:12px;">
                        Za učitelje</div>
                    <div class="cta-title">Jesi li učitelj arapskog?</div>
                    <div class="cta-sub">Pridruži se platformi, postavi svoje kurseve i poveži se sa stotinama učenika
                        koji žele naučiti arapski jezik.</div>
                </div>
                <a href="{{ route('register') }}" class="btn-cta">Postani učitelj →</a>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer>
        <div class="footer-left">
            <div class="en">🌙 ArapskiLearn</div>
            <div class="ar">أهلا وسهلا بكم</div>
        </div>
        <div class="footer-links">
            <a href="#kursevi">Kursevi</a>
            <a href="{{ route('obavjestenja') }}">Obavještenja</a>
            <a href="{{ route('kontakt') }}">Kontakt</a>
            <a href="{{ route('login') }}">Prijava</a>
            <a href="{{ route('register') }}">Registracija</a>
        </div>
        <div class="footer-copy">© 2024 ArapskiLearn — Sva prava zadržava Džejlana Omerović</div>
    </footer>

</body>

</html>