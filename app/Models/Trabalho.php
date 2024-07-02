<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabalho extends Model
{
    use HasFactory;

    protected $table = 'trabalhos';
    protected $fillable = ['titulo', 'descricao', 'data_entrega', 'turma_id', 'aluno_id'];

    protected static function newFactory()
    {
        return \Database\Factories\TrabalhoFactory::new();
    }
}
