<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $fillable = ['nom', 'prenom', 'telephone', 'email', 'date_naissance'];

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }

    public function besoins()
    {
        return $this->hasMany(BesoinEtudiant::class);
    }
}
