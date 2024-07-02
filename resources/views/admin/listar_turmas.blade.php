@extends('layouts.app')

@section('content')
<div class="my-8">
    <h2 class="text-2xl font-semibold mb-4">Lista de Turmas</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($turmas as $turma)
        <div class="bg-white shadow-md rounded-lg p-4">
            <h3 class="text-lg font-semibold mb-2">{{ $turma->disciplina->name }}</h3>
            <p class="text-sm text-gray-500 mb-2">Professor: {{ $turma->professor->name }}</p>
            <p class="text-sm text-gray-500 mb-2">Capacidade: {{ $turma->capacidade }}</p>
            <form action="{{ route('admin.turma.remover', $turma->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">Remover</button>
            </form>
        </div>
        @endforeach
    </div>
</div>
@endsection