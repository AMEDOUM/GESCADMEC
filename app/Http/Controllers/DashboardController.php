<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Inscription;
use App\Models\Paiement;
use App\Models\BesoinEtudiant;

class DashboardController extends Controller
{
    public function index()
    {

        
        // Statistiques simples
        $total_etudiants = Etudiant::count();
        $total_inscriptions = Inscription::count();
        $total_paiements = Paiement::sum('montant');
        $total_besoins = BesoinEtudiant::count();

        // Paiements par mois
        $paiements = Paiement::selectRaw('MONTH(created_at) as mois, SUM(montant) as total')
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        $paiementLabels = $paiements->pluck('mois')->map(function ($m) {
            return date("F", mktime(0, 0, 0, $m, 1));
        });

        $paiementData = $paiements->pluck('total');

        // Inscriptions par mois
        $inscriptions = Inscription::selectRaw('MONTH(created_at) as mois, COUNT(*) as total')
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        $inscriptionLabels = $inscriptions->pluck('mois')->map(function ($m) {
            return date("F", mktime(0, 0, 0, $m, 1));
        });

        $inscriptionData = $inscriptions->pluck('total');

        // Derniers besoins
        $recent_besoins = BesoinEtudiant::latest()->take(5)->get();

        // Vue finale
        return view('dashboard.index', compact(
            'total_etudiants',
            'total_inscriptions',
            'total_paiements',
            'total_besoins',
            'paiementLabels',
            'paiementData',
            'inscriptionLabels',
            'inscriptionData',
            'recent_besoins'
        ));
    }
}
