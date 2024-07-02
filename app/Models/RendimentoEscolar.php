<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RendimentoEscolar extends Model
{
    use HasFactory;

    protected $table = 'rendimento_escolars';
    protected $fillable = ['turma_id', 'aluno_id', 'nota_primeira_prova', 'nota_segunda_prova', 'trabalhos', 'notas_trabalhos'];

    protected static function newFactory()
    {
        return \Database\Factories\RendimentoEscolarFactory::new();
    }
}
