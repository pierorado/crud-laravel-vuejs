<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    public $table = "estudiantes";
    //campos que vas a utilizar en el api
    protected $fillable = [
        'nombre',
        'apellido',
        'foto',
        'id'
    ];

    public function cursos(){
        return $this->belongsToMany(Curso::class,"curso_estudiante");
    }
}
