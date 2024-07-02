<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Aluno;
use App\Models\Turma;
use App\Models\RendimentoEscolar;

class AlunoController extends Controller
{
    public function showLoginForm()
    {
        return view('aluno.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('aluno')->attempt($credentials)) {
            return redirect()->intended('/aluno/turmas');
        }

        return back()->withErrors(['message' => 'Credenciais inválidas.']);
    }

    public function showRegisterForm()
    {
        return view('aluno.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'data_nascimento' => 'required|date',
            'periodo' => 'required|string',
            'username' => 'required|unique:alunos',
            'password' => 'required|min:6',
        ]);

        Aluno::create([
            'nome' => $request->nome,
            'data_nascimento' => $request->data_nascimento,
            'periodo' => $request->periodo,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        return redirect('/aluno/login')->with('success', 'Aluno registrado com sucesso. Faça login para continuar.');
    }

    public function turmas()
    {
        $aluno = Auth::guard('aluno')->user();
        $turmas = $aluno->turmas;
        return view('aluno.turmas', compact('turmas'));
    }

    public function detalhesTurma($id)
    {
        $aluno = Auth::guard('aluno')->user();
        $turma = Turma::findOrFail($id);
        $rendimento = RendimentoEscolar::where('turma_id', $id)
                        ->where('aluno_id', $aluno->id)
                        ->first();
        return view('aluno.detalhes_turma', compact('turma', 'rendimento'));
    }

    public function entregarTrabalho(Request $request, $id)
    {
        // 1. Validar os dados de entrada
        $request->validate([
            'aluno_id' => 'required|exists:alunos,id',
            'trabalho_id' => 'required|exists:trabalhos,id',
            // Adicione outras validações conforme necessário
        ]);

        // 2. Buscar o aluno e o trabalho
        $aluno = Aluno::findOrFail($request->aluno_id);
        $trabalho = Trabalho::findOrFail($request->trabalho_id);

        // 3. Validar a autorização (exemplo: verificar se o trabalho pertence ao aluno)
        // Você pode personalizar essa lógica com base nos requisitos do seu sistema
        if ($trabalho->aluno_id !== $aluno->id) {
            return response()->json([
                'message' => 'Você não tem permissão para entregar este trabalho.'
            ], 403);
        }

        // 4. Registrar a entrega do trabalho (exemplo: atualizar o status de entrega)
        // Aqui você atualizaria o status ou registraria a entrega como necessário
        $trabalho->status_entrega = true;
        $trabalho->save();

        // 5. Responder com uma mensagem de sucesso
        return response()->json([
            'message' => 'Trabalho entregue com sucesso!'
        ]);
    }
}
