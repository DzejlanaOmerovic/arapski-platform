<x-app-layout>
    <x-slot name="header"> Dobrodošli — مرحباً {{ Auth::user()->name }}</x-slot>

    @if(session('success'))
        <div class="alert-success">✓ {{ session('success') }}</div>
    @endif

    <div class="stat-grid">
        <div class="stat-card" style="border-color:#4f46e5;">
            <div class="stat-number" style="color:#4f46e5;">{{ $courses->count() }}</div>
            <div class="stat-label">📚 Mojih kurseva</div>
        </div>
        <div class="stat-card" style="border-color:#f59e0b;">
            <div class="stat-number" style="color:#f59e0b;">{{ $pendingReservations }}</div>
            <div class="stat-label">⏳ Čekaju potvrdu</div>
        </div>
        <div class="stat-card" style="border-color:#22c55e;">
            <div class="stat-number" style="color:#22c55e;">{{ $totalReservations }}</div>
            <div class="stat-label">📅 Ukupno rezervacija</div>
        </div>
        <div class="stat-card" style="border-color:#a855f7;">
            <div class="stat-number" style="color:#a855f7;">{{ $averageRating ? number_format($averageRating, 1) : 'N/A' }}</div>
            <div class="stat-label">⭐ Prosječna ocjena</div>
        </div>
    </div>

    <div class="quick-links">
        <a href="{{ route('teacher.create-course') }}" class="quick-link">+ Novi kurs</a>
        <a href="{{ route('teacher.reservations') }}" class="quick-link">📅 Rezervacije</a>
        <a href="{{ route('teacher.reviews') }}" class="quick-link">⭐ Recenzije</a>
        <a href="{{ route('teacher.profile') }}" class="quick-link">👤 Profil</a>
    </div>

    @if($recentReviews->isNotEmpty())
    <div class="card">
        <div class="card-body">
            <div class="section-title">⭐ Posljednje recenzije</div>
            @foreach($recentReviews as $review)
            <div style="padding:14px 0;border-bottom:1px solid #f1f5f9;">
                <div style="display:flex;justify-content:space-between;align-items:center;">
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div style="width:36px;height:36px;background:linear-gradient(135deg,#818cf8,#a78bfa);border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:0.85rem;">
                            {{ strtoupper(substr($review->student->name, 0, 1)) }}
                        </div>
                        <span style="font-weight:600;color:#1e293b;">{{ $review->student->name }}</span>
                    </div>
                    <span style="color:#f59e0b;font-size:1rem;">{{ str_repeat('★', $review->ocena) }}{{ str_repeat('☆', 5 - $review->ocena) }}</span>
                </div>
                <p style="color:#64748b;font-size:0.88rem;margin-top:8px;margin-left:46px;">{{ $review->komentar ?? 'Bez komentara' }}</p>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</x-app-layout>