<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penalite extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_etape',
        'id_equipe',
        'penalite'
    ];
}
