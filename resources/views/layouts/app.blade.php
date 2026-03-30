<!DOCTYPE html>
<html lang="bs">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ArapskiLearn') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background: #eef0f8;
            color: #1e293b;
            min-height: 100vh;
        }

        /* ═══ NAVIGACIJA ═══ */
        .main-nav {
            background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
            padding: 0 2rem;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 20px rgba(0,0,0,0.4);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-logo {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
            text-decoration: none;
        }

        .nav-logo .logo-en {
            font-size: 1rem;
            font-weight: 800;
            color: white;
            letter-spacing: -0.3px;
        }

        .nav-logo .logo-ar {
            font-size: 0.78rem;
            color: #a5b4fc;
            direction: rtl;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2px;
        }

        .nav-links a {
            color: #a5b4fc;
            text-decoration: none;
            padding: 5px 11px;
            border-radius: 7px;
            font-size: 0.82rem;
            font-weight: 500;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .nav-links a:hover {
            background: rgba(255,255,255,0.12);
            color: white;
        }

        .nav-links a.active {
            background: rgba(99,102,241,0.5);
            color: white;
        }

        .nav-user {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-user .avatar {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #6366f1, #a855f7);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.82rem;
            color: white;
            flex-shrink: 0;
        }

        .nav-user .user-name {
            color: #e2e8f0;
            font-size: 0.82rem;
            font-weight: 500;
        }

        .btn-logout {
            background: rgba(255,255,255,0.1);
            color: #a5b4fc;
            border: 1px solid rgba(255,255,255,0.15);
            padding: 5px 12px;
            border-radius: 7px;
            cursor: pointer;
            font-size: 0.78rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-logout:hover {
            background: rgba(239,68,68,0.3);
            color: #fca5a5;
            border-color: rgba(239,68,68,0.3);
        }

        /* ═══ LAYOUT ═══ */
        .page-wrapper {
            max-width: 1280px;
            margin: 0 auto;
            padding: 20px 24px 40px;
        }

        /* ═══ PAGE HEADER ═══ */
        .page-header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 60%, #a855f7 100%);
            border-radius: 14px;
            padding: 18px 24px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 20px rgba(79,70,229,0.35);
        }

        .page-header h1 {
            color: white;
            font-size: 1.2rem;
            font-weight: 700;
        }

        .page-header .ar-deco {
            color: rgba(255,255,255,0.25);
            font-size: 1.1rem;
            direction: rtl;
            font-weight: 300;
        }

        /* ═══ KARTICE ═══ */
        .card {
            background: white;
            border-radius: 14px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 4px 12px rgba(0,0,0,0.04);
            margin-bottom: 18px;
            overflow: hidden;
        }

        .card-body { padding: 20px 24px; }

        /* ═══ STAT KARTICE ═══ */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 14px;
            margin-bottom: 18px;
        }

        .stat-card {
            background: white;
            border-radius: 14px;
            padding: 18px 16px;
            text-align: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            transition: transform 0.2s, box-shadow 0.2s;
            border-top: 3px solid;
            position: relative;
            overflow: hidden;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: currentColor;
            opacity: 0.04;
            transform: translate(20px, 20px);
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            line-height: 1;
        }

        .stat-label {
            font-size: 0.78rem;
            color: #64748b;
            margin-top: 6px;
            font-weight: 500;
        }

        /* ═══ TABELA ═══ */
        .modern-table {
            width: 100%;
            border-collapse: collapse;
        }

        .modern-table thead {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
        }

        .modern-table thead th {
            color: rgba(255,255,255,0.9);
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding: 12px 18px;
            text-align: left;
        }

        .modern-table tbody tr {
            border-bottom: 1px solid #f1f5f9;
            transition: background 0.15s;
        }

        .modern-table tbody tr:last-child { border-bottom: none; }

        .modern-table tbody tr:hover { background: #fafafa; }

        .modern-table tbody td {
            padding: 13px 18px;
            font-size: 0.88rem;
            color: #374151;
            vertical-align: middle;
        }

        /* ═══ DUGMAD ═══ */
        .btn {
            padding: 6px 14px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 0.78rem;
            font-weight: 600;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .btn:hover { transform: translateY(-1px); filter: brightness(1.1); }
        .btn-primary { background: linear-gradient(135deg, #4f46e5, #7c3aed); color: white; }
        .btn-success { background: linear-gradient(135deg, #22c55e, #16a34a); color: white; }
        .btn-danger { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; }
        .btn-warning { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }
        .btn-info { background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; }

        /* ═══ BADGE ═══ */
        .badge {
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .badge-success { background: #dcfce7; color: #15803d; }
        .badge-warning { background: #fef9c3; color: #92400e; }
        .badge-danger { background: #fee2e2; color: #dc2626; }
        .badge-info { background: #dbeafe; color: #1d4ed8; }
        .badge-purple { background: #ede9fe; color: #6d28d9; }

        /* ═══ FORME ═══ */
        .form-group { margin-bottom: 16px; }

        .form-label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 9px 13px;
            border: 1.5px solid #e5e7eb;
            border-radius: 9px;
            font-size: 0.88rem;
            transition: all 0.2s;
            background: white;
            color: #1e293b;
        }

        .form-control:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79,70,229,0.1);
        }

        /* ═══ FLASH PORUKE ═══ */
        .alert-success {
            background: #f0fdf4;
            border-left: 3px solid #22c55e;
            color: #15803d;
            padding: 12px 16px;
            border-radius: 9px;
            margin-bottom: 16px;
            font-size: 0.88rem;
            font-weight: 500;
        }

        /* ═══ BRZI LINKOVI ═══ */
        .quick-links {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 18px;
        }

        .quick-link {
            background: white;
            border: 1.5px solid #e5e7eb;
            border-radius: 9px;
            padding: 8px 16px;
            font-size: 0.82rem;
            font-weight: 600;
            color: #4f46e5;
            text-decoration: none;
            transition: all 0.2s;
        }

        .quick-link:hover {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            border-color: transparent;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(79,70,229,0.3);
        }

        /* ═══ SECTION TITLE ═══ */
        .section-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 14px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f1f5f9;
        }

        /* ═══ ARAPSKI UKRAS ═══ */
        .ar-watermark {
            position: fixed;
            bottom: 16px;
            right: 20px;
            font-size: 5rem;
            color: rgba(99,102,241,0.07);
            direction: rtl;
            pointer-events: none;
            z-index: 0;
            line-height: 1;
        }

        /* ═══ EMPTY STATE ═══ */
        .empty-state {
            text-align: center;
            padding: 48px 24px;
            color: #94a3b8;
        }

        .empty-state .empty-icon { font-size: 3rem; margin-bottom: 12px; }
        .empty-state p { font-size: 0.9rem; }
    </style>
</head>
<body>
    @include('layouts.navigation')

    <div class="ar-watermark">بسم الله</div>

    <div class="page-wrapper">
        @if (isset($header))
            <div class="page-header">
                <h1>{{ $header }}</h1>
                <span class="ar-deco">الله أكبر ٭ سبحان الله</span>
            </div>
        @endif
        <main>{{ $slot }}</main>
    </div>
</body>
</html>