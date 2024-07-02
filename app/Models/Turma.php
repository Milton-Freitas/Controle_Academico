<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;

    protected $table = 'turmas';
    protected $fillable = ['nome', 'disciplina_id', 'professor_id'];

    protected static function newFactory()
    {
        return \Database\Factories\TurmaFactory::new();
    }
}
