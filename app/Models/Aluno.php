<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'sexo',
        'email',
        'telefone',
        'data_nascimento'
    ];

    // public function getSexoAttribute($value)
    // {
    //     return $value === 'M' ? 'Masculino' : 'Feminino';
    // }
}
