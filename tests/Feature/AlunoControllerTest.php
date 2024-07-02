<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Turma;
use App\Models\Aluno;

class AlunoControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function listar_turmas()
    {
        Turma::factory()->count(3)->create();

        $response = $this->get(route('aluno.turmas.listar'));

        $response->assertStatus(200);
        $response->assertViewHas('turmas');
    }

    #[Test]
    public function detalhes_turma()
    {
        $turma = Turma::factory()->create();

        $response = $this->get(route('aluno.turmas.detalhes', $turma->id));

        $response->assertStatus(200);
        $response->assertViewHas('turma');
    }

    #[Test]
    public function test_entregar_trabalho()
    {
        // Crie uma instância do modelo necessário
        $aluno = \App\Models\Aluno::factory()->create();
        $trabalho = \App\Models\Trabalho::factory()->create();

        // Dados a serem enviados no request
        $data = [
            'aluno_id' => $aluno->id,
            'trabalho_id' => $trabalho->id,
            // Adicione outros dados necessários
        ];

        // Chame a rota e passe os dados
        $response = $this->post('/entregar-trabalho/' . $trabalho->id, $data);

        // Verifique se o status da resposta é 200 ou 302, dependendo da lógica do seu aplicativo
        $response->assertStatus(200);

        // Verifique se a resposta contém a mensagem esperada
        $response->assertJson([
            'message' => 'Trabalho entregue com sucesso!'
        ]);
    }
}
