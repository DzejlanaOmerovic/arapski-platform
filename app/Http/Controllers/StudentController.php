<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Reservation;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    // Dashboard
    public function index()
    {
        $student = Auth::user();
        $myReservations = Reservation::where('student_id', $student->id)
            ->with('teacher', 'course')
            ->latest()->take(5)->get();
        $totalReservations = Reservation::where('student_id', $student->id)->count();
        $featuredCourses = Course::where('is_featured', true)
            ->where('is_active', true)
            ->with('teacher')->take(3)->get();

        return view('student.dashboard', compact(
            'student', 'myReservations', 'totalReservations', 'featuredCourses'
        ));
    }

    // Pretraga učitelja i kurseva
    public function search(Request $request)
    {
        $query = Course::where('is_active', true)->with('teacher');

        if ($request->filled('kljucna_rijec')) {
            $query->where(function($q) use ($request) {
                $q->where('naziv', 'like', '%' . $request->kljucna_rijec . '%')
                  ->orWhere('opis', 'like', '%' . $request->kljucna_rijec . '%');
            });
        }

        if ($request->filled('nivo')) {
            $query->where('nivo', $request->nivo);
        }

        if ($request->filled('tip')) {
            $query->where('tip', $request->tip);
        }

        if ($request->filled('max_cena')) {
            $query->where('cena', '<=', $request->max_cena);
        }

        // Sortiranje po ocjeni učitelja
        $courses = $query->get()->sortByDesc(function($course) {
            return Review::where('teacher_id', $course->teacher_id)->avg('ocena');
        });

        return view('student.search', compact('courses'));
    }

    // Detalji kursa
    public function courseDetail(Course $course)
    {
        $reviews = Review::where('teacher_id', $course->teacher_id)
            ->with('student')->latest()->take(5)->get();
        $averageRating = Review::where('teacher_id', $course->teacher_id)->avg('ocena');
        return view('student.course-detail', compact('course', 'reviews', 'averageRating'));
    }

    // Rezerviši kurs
    public function reserve(Request $request, Course $course)
    {
        $request->validate([
            'datum'    => 'required|date|after:now',
            'napomena' => 'nullable|string|max:500',
        ]);

        // Provjeri da li već postoji rezervacija
        $existing = Reservation::where('student_id', Auth::id())
            ->where('teacher_id', $course->teacher_id)
            ->where('datum', $request->datum)
            ->where('status', '!=', 'rejected')
            ->first();

        if ($existing) {
            return back()->withErrors(['datum' => 'Već imate rezervaciju u to vrijeme!']);
        }

        Reservation::create([
            'student_id'      => Auth::id(),
            'teacher_id'      => $course->teacher_id,
            'course_id'       => $course->id,
            'datum'           => $request->datum,
            'trajanje_minuta' => $course->trajanje_minuta,
            'napomena'        => $request->napomena,
            'cena'            => $course->cena,
            'status'          => 'pending',
        ]);

        return redirect()->route('student.reservations')
            ->with('success', 'Rezervacija je poslana! Čekajte potvrdu učitelja.');
    }

    // Moje rezervacije
    public function reservations()
    {
        $reservations = Reservation::where('student_id', Auth::id())
            ->with('teacher', 'course')
            ->latest()->get();
        return view('student.reservations', compact('reservations'));
    }

    // Ostavi recenziju
    public function storeReview(Request $request, Reservation $reservation)
    {
        if ($reservation->student_id !== Auth::id()) abort(403);
        if ($reservation->status !== 'completed') {
            return back()->withErrors(['error' => 'Možete ocijeniti samo završene časove!']);
        }

        $request->validate([
            'ocena'    => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:1000',
        ]);

        Review::updateOrCreate(
            ['reservation_id' => $reservation->id],
            [
                'student_id' => Auth::id(),
                'teacher_id' => $reservation->teacher_id,
                'ocena'      => $request->ocena,
                'komentar'   => $request->komentar,
            ]
        );

        return back()->with('success', 'Recenzija je sačuvana!');
    }
}