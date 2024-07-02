<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Disciplina;
use App\Models\Professor;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function listar_disciplinas()
    {
        Disciplina::factory()->count(3)->create();

        $response = $this->get(route('admin.disciplinas.listar'));

        $response->assertStatus(200);
        $response->assertViewHas('disciplinas');
    }

    #[Test]
    public function registrar_disciplina()
    {
        $data = [
            'nome' => 'Matemática',
            'descricao' => 'Disciplina de Matemática'
        ];

        $response = $this->post(route('admin.disciplinas.registrar'), $data);

        $response->assertStatus(302);
        $this->assertDatabaseHas('disciplinas', $data);
    }

    #[Test]
    public function remover_disciplina()
    {
        $disciplina = Disciplina::factory()->create();

        $response = $this->delete(route('admin.disciplinas.remover', $disciplina->id));

        $response->assertStatus(302);
        $this->assertDeleted($disciplina);
    }

    #[Test]
    public function listar_professores()
    {
        Professor::factory()->count(3)->create();

        $response = $this->get(route('admin.professores.listar'));

        $response->assertStatus(200);
        $response->assertViewHas('professores');
    }

    #[Test]
    public function remover_professor()
    {
        $professor = Professor::factory()->create();

        $response = $this->delete(route('admin.professores.remover', $professor->id));

        $response->assertStatus(302);
        $this->assertDeleted($professor);
    }
}
