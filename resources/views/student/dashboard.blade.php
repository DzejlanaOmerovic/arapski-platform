<x-app-layout>
    <x-slot name="header">Dobrodošli, {{ Auth::user()->name }}! 🌙 أهلاً</x-slot>

    @if(session('success'))
        <div class="alert-success">✓ {{ session('success') }}</div>
    @endif

    <div class="stat-grid">
        <div class="stat-card" style="border-color:#4f46e5;">
            <div class="stat-number" style="color:#4f46e5;">{{ $totalReservations }}</div>
            <div class="stat-label">📅 Ukupno rezervacija</div>
        </div>
        <div class="stat-card" style="border-color:#22c55e;">
            <div class="stat-number" style="color:#22c55e;">{{ $myReservations->where('status','confirmed')->count() }}</div>
            <div class="stat-label">✅ Potvrđenih časova</div>
        </div>
        <div class="stat-card" style="border-color:#a855f7;">
            <div class="stat-number" style="color:#a855f7;">{{ $myReservations->where('status','completed')->count() }}</div>
            <div class="stat-label">🎓 Završenih časova</div>
        </div>
    </div>

    <div class="quick-links">
        <a href="{{ route('student.search') }}" class="quick-link">🔍 Pretraži kurseve</a>
        <a href="{{ route('student.reservations') }}" class="quick-link">📅 Moje rezervacije</a>
    </div>

    @if($featuredCourses->isNotEmpty())
    <div class="card">
        <div class="card-body">
            <div class="section-title">⭐ Istaknuti kursevi — الدورات المميزة</div>
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:16px;">
                @foreach($featuredCourses as $course)
                <div style="border:1.5px solid #e5e7eb;border-radius:12px;padding:18px;transition:all 0.2s;" onmouseover="this.style.borderColor='#4f46e5'" onmouseout="this.style.borderColor='#e5e7eb'">
                    <div style="font-size:1.8rem;margin-bottom:8px;">📖</div>
                    <h4 style="font-weight:700;color:#1e293b;margin-bottom:4px;">{{ $course->naziv }}</h4>
                    <p style="font-size:0.82rem;color:#64748b;margin-bottom:8px;">{{ $course->teacher->name }}</p>
                    <span class="badge badge-info">{{ ucfirst($course->nivo) }}</span>
                    <span class="badge badge-purple" style="margin-left:4px;">{{ ucfirst($course->tip) }}</span>
                    <div style="margin-top:12px;display:flex;justify-content:space-between;align-items:center;">
                        <span style="font-weight:700;color:#4f46e5;">{{ $course->cena ? $course->cena.' KM' : 'Besplatno' }}</span>
                        <a href="{{ route('student.course-detail', $course) }}" class="btn btn-primary" style="font-size:0.78rem;padding:5px 12px;">Pogledaj →</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    @if($myReservations->isNotEmpty())
    <div class="card">
        <div class="card-body">
            <div class="section-title">📅 Posljednje rezervacije</div>
            @foreach($myReservations as $res)
            <div style="display:flex;justify-content:space-between;align-items:center;padding:12px 0;border-bottom:1px solid #f1f5f9;">
                <div>
                    <p style="font-weight:600;color:#1e293b;margin:0;">{{ $res->course->naziv ?? 'Privatni čas' }}</p>
                    <p style="font-size:0.82rem;color:#64748b;margin:2px 0;">{{ $res->teacher->name }} • {{ $res->datum->format('d.m.Y H:i') }}</p>
                </div>
                <span class="badge {{ $res->status === 'confirmed' ? 'badge-success' : ($res->status === 'pending' ? 'badge-warning' : ($res->status === 'completed' ? 'badge-info' : 'badge-danger')) }}">
                    {{ $res->status === 'confirmed' ? 'Potvrđena' : ($res->status === 'pending' ? 'Na čekanju' : ($res->status === 'completed' ? 'Završena' : 'Odbijena')) }}
                </span>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</x-app-layout>