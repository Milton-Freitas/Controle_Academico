<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Turma;

class ProfessorControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function listar_turmas()
    {
        Turma::factory()->count(3)->create();

        $response = $this->get(route('professor.turmas.listar'));

        $response->assertStatus(200);
        $response->assertViewHas('turmas');
    }

    #[Test]
    public function detalhes_turma()
    {
        $turma = Turma::factory()->create();

        $response = $this->get(route('professor.turmas.detalhes', $turma->id));

        $response->assertStatus(200);
        $response->assertViewHas('turma');
    }

    #[Test]
    public function atribuir_notas()
    {
        $turma = Turma::factory()->create();
        $data = [
            'notas' => [
                ['aluno_id' => 1, 'nota' => 8],
                ['aluno_id' => 2, 'nota' => 9],
            ]
        ];

        $response = $this->post(route('professor.turmas.atribuirNotas', $turma->id), $data);

        $response->assertStatus(302);
        // Verifique se as notas foram atribuídas corretamente no banco de dados
    }
}
