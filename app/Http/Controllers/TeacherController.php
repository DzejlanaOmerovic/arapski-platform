<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Reservation;
use App\Models\Review;
use App\Models\TeacherProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    // Dashboard
    public function index()
    {
        $teacher = Auth::user();
        $courses = Course::where('teacher_id', $teacher->id)->get();
        $pendingReservations = Reservation::where('teacher_id', $teacher->id)
            ->where('status', 'pending')->count();
        $totalReservations = Reservation::where('teacher_id', $teacher->id)->count();
        $averageRating = Review::where('teacher_id', $teacher->id)->avg('ocena');
        $recentReviews = Review::where('teacher_id', $teacher->id)
            ->with('student')->latest()->take(3)->get();

        return view('teacher.dashboard', compact(
            'teacher', 'courses', 'pendingReservations',
            'totalReservations', 'averageRating', 'recentReviews'
        ));
    }

    // Lista kurseva
    public function courses()
    {
        $courses = Course::where('teacher_id', Auth::id())->latest()->get();
        return view('teacher.courses', compact('courses'));
    }

    // Forma za novi kurs
    public function createCourse()
    {
        return view('teacher.create-course');
    }

    // Sačuvaj novi kurs
    public function storeCourse(Request $request)
    {
        $request->validate([
            'naziv'           => 'required|string|max:255',
            'opis'            => 'nullable|string',
            'nivo'            => 'required|in:pocetni,srednji,napredni',
            'cena'            => 'nullable|numeric|min:0',
            'tip'             => 'required|in:grupni,individualni',
            'max_students'    => 'nullable|integer|min:1',
            'trajanje_minuta' => 'required|integer|min:15',
        ]);

        Course::create([
            'teacher_id'      => Auth::id(),
            'naziv'           => $request->naziv,
            'opis'            => $request->opis,
            'nivo'            => $request->nivo,
            'cena'            => $request->cena,
            'tip'             => $request->tip,
            'max_students'    => $request->max_students,
            'trajanje_minuta' => $request->trajanje_minuta,
            'is_active'       => true,
        ]);

        return redirect()->route('teacher.courses')
            ->with('success', 'Kurs je uspješno kreiran!');
    }

    // Uredi kurs
    public function editCourse(Course $course)
    {
        if ($course->teacher_id !== Auth::id()) abort(403);
        return view('teacher.edit-course', compact('course'));
    }

    // Ažuriraj kurs
    public function updateCourse(Request $request, Course $course)
    {
        if ($course->teacher_id !== Auth::id()) abort(403);

        $request->validate([
            'naziv'           => 'required|string|max:255',
            'opis'            => 'nullable|string',
            'nivo'            => 'required|in:pocetni,srednji,napredni',
            'cena'            => 'nullable|numeric|min:0',
            'tip'             => 'required|in:grupni,individualni',
            'trajanje_minuta' => 'required|integer|min:15',
        ]);

        $course->update($request->all());

        return redirect()->route('teacher.courses')
            ->with('success', 'Kurs je ažuriran!');
    }

    // Obriši kurs
    public function deleteCourse(Course $course)
    {
        if ($course->teacher_id !== Auth::id()) abort(403);
        $course->delete();
        return back()->with('success', 'Kurs je obrisan.');
    }

    // Rezervacije
    public function reservations()
    {
        $reservations = Reservation::where('teacher_id', Auth::id())
            ->with('student', 'course')
            ->latest()->get();
        return view('teacher.reservations', compact('reservations'));
    }

    // Prihvati rezervaciju
    public function approveReservation(Reservation $reservation)
    {
        if ($reservation->teacher_id !== Auth::id()) abort(403);
        $reservation->update(['status' => 'confirmed']);
        return back()->with('success', 'Rezervacija je potvrđena!');
    }

    // Odbij rezervaciju
    public function rejectReservation(Reservation $reservation)
    {
        if ($reservation->teacher_id !== Auth::id()) abort(403);
        $reservation->update(['status' => 'rejected']);
        return back()->with('success', 'Rezervacija je odbijena.');
    }

    // Recenzije
    public function reviews()
    {
        $reviews = Review::where('teacher_id', Auth::id())
            ->with('student')->latest()->get();
        $averageRating = $reviews->avg('ocena');
        $ratingStats = [];
        for ($i = 1; $i <= 5; $i++) {
            $ratingStats[$i] = $reviews->where('ocena', $i)->count();
        }
        return view('teacher.reviews', compact('reviews', 'averageRating', 'ratingStats'));
    }

    // Profil učitelja
    public function profile()
    {
        $profile = TeacherProfile::firstOrCreate(
            ['user_id' => Auth::id()],
            ['offers_individual' => true]
        );
        return view('teacher.profile', compact('profile'));
    }

    // Ažuriraj profil
    public function updateProfile(Request $request)
    {
        $request->validate([
            'about'          => 'nullable|string',
            'arabic_level'   => 'nullable|string|max:100',
            'price_per_hour' => 'nullable|numeric|min:0',
            'teaching_style' => 'nullable|string|max:255',
        ]);

        TeacherProfile::updateOrCreate(
            ['user_id' => Auth::id()],
            $request->only(['about', 'arabic_level', 'price_per_hour', 'teaching_style',
                           'offers_group', 'offers_individual'])
        );

        return back()->with('success', 'Profil je ažuriran!');
    }

    public function completeReservation(Reservation $reservation)
{
    if ($reservation->teacher_id !== Auth::id()) abort(403);
    $reservation->update(['status' => 'completed']);
    return back()->with('success', 'Čas je označen kao završen!');
}
}