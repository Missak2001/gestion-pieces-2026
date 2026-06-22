<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PosteTravail;
use App\Models\UserQualification;
use Illuminate\Http\Request;

class UserQualificationController extends Controller
{
    public function index()
    {
        $qualifications = UserQualification::with(['user', 'posteTravail'])->get();

        $users = User::orderBy('name')->get();
        $postes = PosteTravail::orderBy('libelle')->get();

        return view('qualifications.index', compact(
            'qualifications',
            'users',
            'postes'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'poste_travail_id' => 'required|exists:postes_travail,id',
        ]);

        UserQualification::firstOrCreate($validated);

        return redirect()
            ->route('qualifications.index')
            ->with('success', 'Qualification ajoutée.');
    }

    public function destroy(UserQualification $qualification)
    {
        $qualification->delete();

        return back()->with('success', 'Qualification supprimée.');
    }
}
