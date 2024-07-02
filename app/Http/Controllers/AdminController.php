<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disciplina;
use App\Models\Turma;
use App\Models\Professor;

class AdminController extends Controller
{
    public function listarDisciplinas()
    {
        $disciplinas = Disciplina::all();
        return view('admin.listar_disciplinas', compact('disciplinas'));
    }

    public function registrarDisciplina(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'ementa' => 'required|string',
        ]);

        Disciplina::create([
            'nome' => $request->name,
            'ementa' => $request->ementa,
        ]);

        return redirect()->back()->with('success', 'Disciplina registrada com sucesso.');
    }

    public function removerDisciplina($id)
    {
        Disciplina::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Disciplina removida com sucesso.');
    }

    public function listarTurmas()
    {
        $turmas = Turma::all();
        return view('admin.listar_turmas', compact('turmas'));
    }

    public function registrarTurma(Request $request)
    {
        $request->validate([
            'disciplina_id' => 'required|exists:disciplinas,id',
            'professor_id' => 'required|exists:professors,id',
            'capacidade' => 'required|integer|min:1',
        ]);

        Turma::create([
            'disciplina_id' => $request->disciplina_id,
            'professor_id' => $request->professor_id,
            'capacidade' => $request->capacidade,
        ]);

        return redirect()->back()->with('success', 'Turma registrada com sucesso.');
    }

    public function removerTurma($id)
    {
        Turma::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Turma removida com sucesso.');
    }

    public function listarProfessores()
    {
        $professores = Professor::all();
        return view('admin.listar_professores', compact('professores'));
    }

    public function registrarProfessor(Request $request)
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

        return redirect()->back()->with('success', 'Professor registrado com sucesso.');
    }

    public function removerProfessor($id)
    {
        Professor::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Professor removido com sucesso.');
    }
}
