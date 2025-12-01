<?php

namespace App\Http\Controllers;

use App\Models\BesoinEtudiant;
use App\Models\Etudiant;
use Illuminate\Http\Request;

class BesoinEtudiantController extends Controller
{
    public function index()
    {
        $besoins = BesoinEtudiant::with('etudiant')->latest()->get();

        return view('besoins.index', compact('besoins'));
    }

    public function create()
    {
        $etudiants = Etudiant::all();

        return view('besoins.create', compact('etudiants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'description' => 'required|string|max:255',
        ]);

        BesoinEtudiant::create([
            'etudiant_id' => $request->etudiant_id,
            'description' => $request->description,
            'etat' => 'en attente',
        ]);

        return redirect()->route('besoins.index')->with('success', 'Besoin ajouté avec succès !');
    }

    public function update(Request $request, BesoinEtudiant $besoin)
    {
        $besoin->update([
            'etat' => $request->etat
        ]);

        return back()->with('success', 'Statut mis à jour !');
    }
}
