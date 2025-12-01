<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    protected $fillable = ['nom', 'description'];

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }
}
