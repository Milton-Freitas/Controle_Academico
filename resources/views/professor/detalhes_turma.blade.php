@extends('layouts.app')

@section('content')
<div class="my-8">
    <h2 class="text-2xl font-semibold mb-4">Detalhes da Turma</h2>
    <div class="bg-white shadow-md rounded-lg p-4">
        <h3 class="text-lg font-semibold mb-2">{{ $turma->disciplina->name }}</h3>
        <p class="text-sm text-gray-500 mb-2">Professor: {{ $turma->professor->name }}</p>
        <p class="text-sm text-gray-500 mb-2">Capacidade: {{ $turma->capacidade }}</p>
        <h4 class="text-xl font-semibold mt-4 mb-2">Trabalhos Entregues</h4>
        <ul>
            @foreach ($trabalhos as $trabalho)
            <li>{{ $trabalho }}</li>
            @endforeach
        </ul>
        <form action="{{ route('professor.turma.atribuir_notas', $turma->id) }}" method="POST">
            @csrf
            <div class="mt-4">
                <label for="nota1" class="block text-sm font-medium text-gray-700">Nota 1a Prova</label>
                <input type="number" id="nota1" name="nota1" step="0.1" min="0" max="20" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div class="mt-4">
                <label for="nota2" class="block text-sm font-medium text-gray-700">Nota 2a Prova</label>
                <input type="number" id="nota2" name="nota2" step="0.1" min="0" max="20" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <button type="submit" class="mt-4 w-full bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">Atribuir Notas</button>
        </form>
    </div>
</div>
@endsection