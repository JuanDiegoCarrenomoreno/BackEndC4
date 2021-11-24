<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residentes extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['cedula', 'nombre', 'apartamento'];
}
