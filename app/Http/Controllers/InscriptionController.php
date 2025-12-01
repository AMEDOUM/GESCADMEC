<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use App\Models\Etudiant;
use App\Models\Niveau;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InscriptionController extends Controller
{
    public function index()
    {
        $inscriptions = Inscription::with(['etudiant', 'niveau'])->get();
        return view('inscriptions.index', compact('inscriptions'));
    }

    public function create()
    {
        $etudiants = Etudiant::all();
        $niveaux = Niveau::all();
        return view('inscriptions.create', compact('etudiants', 'niveaux'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'niveau_id' => 'required|exists:niveaux,id',
            'montant_total' => 'required|numeric|min:0',
            'montant_paye' => 'required|numeric|min:0',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        $montant_restant = $request->montant_total - $request->montant_paye;

        Inscription::create([
            'etudiant_id' => $request->etudiant_id,
            'niveau_id' => $request->niveau_id,
            'montant_total' => $request->montant_total,
            'montant_paye' => $request->montant_paye,
            'montant_restant' => $montant_restant,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
        ]);

        return redirect()->route('inscriptions.index')->with('success', 'Inscription ajoutée avec succès.');
    }

    public function edit(Inscription $inscription)
    {
        $etudiants = Etudiant::all();
        $niveaux = Niveau::all();
        return view('inscriptions.edit', compact('inscription', 'etudiants', 'niveaux'));
    }

    public function update(Request $request, Inscription $inscription)
    {
        $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'niveau_id' => 'required|exists:niveaux,id',
            'montant_total' => 'required|numeric|min:0',
            'montant_paye' => 'required|numeric|min:0',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        $montant_restant = $request->montant_total - $request->montant_paye;

        $inscription->update([
            'etudiant_id' => $request->etudiant_id,
            'niveau_id' => $request->niveau_id,
            'montant_total' => $request->montant_total,
            'montant_paye' => $request->montant_paye,
            'montant_restant' => $montant_restant,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
        ]);

        return redirect()->route('inscriptions.index')->with('success', 'Inscription mise à jour avec succès.');
    }

    public function destroy(Inscription $inscription)
    {
        $inscription->delete();
        return redirect()->route('inscriptions.index')->with('success', 'Inscription supprimée avec succès.');
    }

    public function receipt($id)
    {
        $inscription = \App\Models\Inscription::with(['etudiant', 'niveau', 'paiements'])->findOrFail($id);

        $pdf = Pdf::loadView('inscriptions.receipt', compact('inscription'));
        // Output PDF with inline disposition so it opens in browser as preview
        return response()->streamDownload(
            fn() => print($pdf->output()),
            'Recu_' . $inscription->etudiant->nom . '.pdf',
            ['Content-Type' => 'application/pdf', 'Content-Disposition' => 'inline']
        );
    }

}
