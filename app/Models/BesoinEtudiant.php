<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BesoinEtudiant extends Model
{
    use HasFactory;

    protected $fillable = [
        'etudiant_id',
        'description',
        'etat', // exemple : "en attente", "validé", "refusé"
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }
}
