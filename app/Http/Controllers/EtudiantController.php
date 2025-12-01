<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    // Liste de tous les étudiants
    public function index()
    {
        $etudiants = Etudiant::all();
        return view('etudiants.index', compact('etudiants'));
    }

    // Affiche le formulaire d'ajout
    public function create()
    {
        return view('etudiants.create');
    }

    // Enregistre un nouvel étudiant
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'date_naissance' => 'nullable|date',
        ]);

        Etudiant::create($request->all());

        return redirect()->route('etudiants.index')
            ->with('success', 'Étudiant ajouté avec succès.');
    }

    // Formulaire d'édition
    public function edit(Etudiant $etudiant)
    {
        return view('etudiants.edit', compact('etudiant'));
    }

    // Mise à jour
    public function update(Request $request, Etudiant $etudiant)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'date_naissance' => 'nullable|date',
        ]);

        $etudiant->update($request->all());

        return redirect()->route('etudiants.index')
            ->with('success', 'Étudiant mis à jour avec succès.');
    }

    // Suppression
    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete();
        return redirect()->route('etudiants.index')
            ->with('success', 'Étudiant supprimé avec succès.');
    }
}
