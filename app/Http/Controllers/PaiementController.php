<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Inscription;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PaiementController extends Controller
{
    public function index()
    {
        $paiements = Paiement::with('inscription.etudiant')->latest()->get();
        return view('paiements.index', compact('paiements'));
    }

    public function create()
    {
        $inscriptions = Inscription::with('etudiant', 'niveau')->get();
        return view('paiements.create', compact('inscriptions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'inscription_id' => 'required|exists:inscriptions,id',
            'montant' => 'required|numeric|min:0',
            'date_paiement' => 'required|date',
            'mode_paiement' => 'required|string|max:50',
        ]);

        $inscription = Inscription::find($request->inscription_id);

        // Enregistrer le paiement
        Paiement::create($request->all());

        // Mettre à jour le montant payé et le montant restant
        $inscription->montant_paye += $request->montant;
        $inscription->montant_restant = $inscription->montant_total - $inscription->montant_paye;
        $inscription->save();

        return redirect()->route('paiements.index')->with('success', 'Paiement enregistré avec succès.');
    }

    public function edit(Paiement $paiement)
    {
        $inscriptions = Inscription::with('etudiant')->get();
        return view('paiements.edit', compact('paiement', 'inscriptions'));
    }

    public function update(Request $request, Paiement $paiement)
    {
        $request->validate([
            'inscription_id' => 'required|exists:inscriptions,id',
            'montant' => 'required|numeric|min:0',
            'date_paiement' => 'required|date',
            'mode_paiement' => 'required|string|max:50',
        ]);

        $paiement->update($request->all());

        return redirect()->route('paiements.index')->with('success', 'Paiement mis à jour avec succès.');
    }

    public function destroy(Paiement $paiement)
    {
        $paiement->delete();
        return redirect()->route('paiements.index')->with('success', 'Paiement supprimé avec succès.');
    }


    public function recu($id)
{
    $paiement = \App\Models\Paiement::with('inscription.etudiant', 'inscription.niveau')->findOrFail($id);

    $pdf = Pdf::loadView('paiements.recu', compact('paiement'));

    $nom_fichier = 'Recu_' . $paiement->inscription->etudiant->nom . '_' . $paiement->id . '.pdf';
    
    return $pdf->stream($nom_fichier); // affiche dans le navigateur
    // ou ->download($nom_fichier) pour forcer le téléchargement
}

}


