<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Runner extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'nom_runner',
        'dossard',
        'genre',
        'dtn',
    ];
}
