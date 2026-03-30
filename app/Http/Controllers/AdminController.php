<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Review;
use App\Models\AdminSetting;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $pendingUsers = User::where('status', 'pending')->count();
        $totalStudents = User::where('role', 'student')->where('status', 'approved')->count();
        $totalTeachers = User::where('role', 'teacher')->where('status', 'approved')->count();
        $recentUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'pendingUsers', 'totalStudents', 'totalTeachers', 'recentUsers'
        ));
    }

    public function pendingUsers()
    {
        $users = User::where('status', 'pending')->latest()->get();
        return view('admin.pending-users', compact('users'));
    }

    public function approveUser(User $user)
    {
        $user->update(['status' => 'approved']);
        return back()->with('success', 'Korisnik ' . $user->name . ' je odobren!');
    }

    public function rejectUser(User $user)
    {
        $user->update(['status' => 'rejected']);
        return back()->with('success', 'Korisnik ' . $user->name . ' je odbijen.');
    }

    public function users()
    {
        $users = User::where('role', '!=', 'admin')->latest()->paginate(15);
        return view('admin.users', compact('users'));
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'Korisnik je obrisan.');
    }

    public function warnUser(User $user)
    {
        $maxWarnings = AdminSetting::get('max_warnings', 3);
        $user->increment('warning_count');

        if ($user->warning_count >= $maxWarnings) {
            $user->update(['status' => 'rejected']);
            return back()->with('success', 'Korisnik je dostigao maksimalan broj upozorenja i izbačen je!');
        }

        return back()->with('success', 'Upozorenje poslano korisniku ' . $user->name . '. Broj upozorenja: ' . $user->warning_count);
    }

    public function reviews()
    {
        $reviews = Review::with(['student', 'teacher'])->latest()->paginate(15);
        return view('admin.reviews', compact('reviews'));
    }

    public function settings()
    {
        $passwordHistoryCount = AdminSetting::get('password_history_count', 3);
        $maxWarnings = AdminSetting::get('max_warnings', 3);
        return view('admin.settings', compact('passwordHistoryCount', 'maxWarnings'));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'password_history_count' => 'required|integer|min:1|max:10',
            'max_warnings'           => 'required|integer|min:1|max:10',
        ]);

        AdminSetting::set('password_history_count', $request->password_history_count);
        AdminSetting::set('max_warnings', $request->max_warnings);

        return back()->with('success', 'Podešavanja su sačuvana!');
    }

    public function notifications()
    {
        $notifications = Notification::latest()->get();
        return view('admin.notifications', compact('notifications'));
    }

    public function storeNotification(Request $request)
    {
        $request->validate([
            'naslov'  => 'required|string|max:255',
            'sadrzaj' => 'required|string',
            'tip'     => 'required|in:vijest,promocija,dogadjaj,upozorenje',
        ]);

        Notification::create([
            'naslov'     => $request->naslov,
            'sadrzaj'    => $request->sadrzaj,
            'tip'        => $request->tip,
            'is_active'  => true,
            'created_by' => Auth::id(),
        ]);

        return back()->with('success', 'Obavještenje je objavljeno!');
    }

    public function deleteNotification(Notification $notification)
    {
        $notification->delete();
        return back()->with('success', 'Obavještenje je obrisano.');
    }
}