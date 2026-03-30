<x-app-layout>
    <x-slot name="header">Admin Panel — لوحة التحكم</x-slot>

    @if(session('success'))
        <div class="alert-success">✓ {{ session('success') }}</div>
    @endif

    <div class="stat-grid">
        <div class="stat-card" style="border-color:#f59e0b;">
            <div class="stat-number" style="color:#f59e0b;">{{ $pendingUsers }}</div>
            <div class="stat-label">⏳ Čekaju odobrenje</div>
        </div>
        <div class="stat-card" style="border-color:#4f46e5;">
            <div class="stat-number" style="color:#4f46e5;">{{ $totalStudents }}</div>
            <div class="stat-label">🎓 Učenika</div>
        </div>
        <div class="stat-card" style="border-color:#22c55e;">
            <div class="stat-number" style="color:#22c55e;">{{ $totalTeachers }}</div>
            <div class="stat-label">👨‍🏫 Učitelja</div>
        </div>
    </div>

    <div class="quick-links">
        <a href="{{ route('admin.pending-users') }}" class="quick-link">⏳ Zahtjevi za registraciju</a>
        <a href="{{ route('admin.users') }}" class="quick-link">👥 Svi korisnici</a>
        <a href="{{ route('admin.reviews') }}" class="quick-link">⭐ Recenzije</a>
        <a href="{{ route('admin.notifications') }}" class="quick-link">📢 Obavještenja</a>
        <a href="{{ route('admin.settings') }}" class="quick-link">⚙️ Podešavanja</a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="section-title">👥 Posljednji registrovani korisnici</div>
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>Ime</th>
                        <th>Email</th>
                        <th>Uloga</th>
                        <th>Status</th>
                        <th>Datum</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentUsers as $user)
                    <tr>
                        <td style="font-weight:600;">{{ $user->name }}</td>
                        <td style="color:#64748b;">{{ $user->email }}</td>
                        <td><span class="badge {{ $user->role === 'teacher' ? 'badge-success' : ($user->role === 'admin' ? 'badge-danger' : 'badge-info') }}">{{ ucfirst($user->role) }}</span></td>
                        <td><span class="badge {{ $user->status === 'approved' ? 'badge-success' : ($user->status === 'pending' ? 'badge-warning' : 'badge-danger') }}">{{ $user->status === 'approved' ? 'Odobren' : ($user->status === 'pending' ? 'Na čekanju' : 'Odbijen') }}</span></td>
                        <td style="color:#64748b;font-size:0.85rem;">{{ $user->created_at->format('d.m.Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>