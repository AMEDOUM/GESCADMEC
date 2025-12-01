<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    protected $fillable = [
        'etudiant_id', 'niveau_id', 'date_inscription',
        'montant_total', 'montant_paye', 'montant_restant', 'date_debut', 'date_fin'
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }
}
