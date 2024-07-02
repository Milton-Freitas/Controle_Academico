<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Professor;
use App\Models\Turma;
use App\Models\RendimentoEscolar;

class ProfessorController extends Controller
{
    public function showLoginForm()
    {
        return view('professor.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('professor')->attempt($credentials)) {
            return redirect()->intended('/professor/turmas');
        }

        return back()->withErrors(['message' => 'Credenciais inválidas.']);
    }

    public function showRegisterForm()
    {
        return view('professor.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'posicao' => 'required|string',
            'data_nascimento' => 'required|date',
            'username' => 'required|unique:professors',
            'password' => 'required|min:6',
        ]);

        $professor = new Professor();
        $professor->nome = $request->nome;
        $professor->posicao = $request->posicao;
        $professor->data_nascimento = $request->data_nascimento;
        $professor->username = $request->username;
        $professor->password = Hash::make($request->password);
        $professor->save();

        return redirect('/professor/login')->with('success', 'Professor registrado com sucesso. Faça login para continuar.');
    }

    public function turmas()
    {
        $professor = Auth::guard('professor')->user();
        $turmas = Turma::where('professor_id', $professor->id)->get();
        return view('professor.turmas', compact('turmas'));
    }

    public function detalhesTurma($id)
    {
        $turma = Turma::findOrFail($id);
        $rendimentos = RendimentoEscolar::where('turma_id', $id)->get();
        return view('professor.detalhes_turma', compact('turma', 'rendimentos'));
    }

    public function atribuirNotas(Request $request, $id)
    {
        $request->validate([
            'nota_primeira_prova' => 'required|numeric|min:0|max:20',
            'nota_segunda_prova' => 'required|numeric|min:0|max:20',
        ]);

        foreach ($request->alunos as $aluno_id => $notas) {
            RendimentoEscolar::updateOrCreate(
                ['turma_id' => $id, 'aluno_id' => $aluno_id],
                [
                    'nota_primeira_prova' => $notas['nota_primeira_prova'],
                    'nota_segunda_prova' => $notas['nota_segunda_prova'],
                ]
            );
        }

        return redirect()->back()->with('success', 'Notas atribuídas com sucesso.');
    }
}
