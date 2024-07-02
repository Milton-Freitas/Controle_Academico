@extends('layouts.app')

@section('content')
<div class="my-8">
    <h2 class="text-2xl font-semibold mb-4">Lista de Professores</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($professores as $professor)
        <div class="bg-white shadow-md rounded-lg p-4">
            <h3 class="text-lg font-semibold mb-2">{{ $professor->name }}</h3>
            <p class="text-sm text-gray-500 mb-2">Cargo: {{ $professor->cargo }}</p>
            <p class="text-sm text-gray-500 mb-2">Data de Nascimento: {{ $professor->birth_date }}</p>
            <form action="{{ route('admin.professor.remover', $professor->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">Remover</button>
            </form>
        </div>
        @endforeach
    </div>
</div>
@endsection