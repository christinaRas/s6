<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Runner_cat extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_runner',
        'id_categorie',
    ];
}
