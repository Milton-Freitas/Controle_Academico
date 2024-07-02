<?php

namespace Tests\Browser;

use App\Models\Aluno;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AlunoLoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testLoginAluno()
    {
        $aluno = Aluno::factory()->create([
            'username' => 'aluno_teste',
            'password' => bcrypt('password123'),
        ]);

        $this->browse(function (Browser $browser) use ($aluno) {
            $browser->visit('/aluno/login')
                    ->type('username', $aluno->username)
                    ->type('password', 'password123')
                    ->press('Entrar')
                    ->assertPathIs('/aluno/turmas');
        });
    }
}
