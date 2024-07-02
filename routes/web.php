<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\AlunoController;

// Rotas do Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/disciplinas', [AdminController::class, 'listarDisciplinas'])->name('disciplinas.listar');
    Route::post('/disciplinas/registrar', [AdminController::class, 'registrarDisciplina'])->name('disciplinas.registrar');
    Route::delete('/disciplinas/{id}', [AdminController::class, 'removerDisciplina'])->name('disciplinas.remover');
    Route::get('/professores', [AdminController::class, 'listarProfessores'])->name('professores.listar');
    Route::delete('/professores/{id}', [AdminController::class, 'removerProfessor'])->name('professores.remover');
});

// Rotas do Professor
Route::prefix('professor')->name('professor.')->group(function () {
    Route::get('/turmas', [ProfessorController::class, 'listarTurmas'])->name('turmas.listar');
    Route::get('/turmas/{id}', [ProfessorController::class, 'detalhesTurma'])->name('turmas.detalhes');
    Route::post('/turmas/{id}/notas', [ProfessorController::class, 'atribuirNotas'])->name('turmas.atribuirNotas');
});

// Rotas do Aluno
Route::prefix('aluno')->name('aluno.')->group(function () {
    Route::get('/turmas', [AlunoController::class, 'listarTurmas'])->name('turmas.listar');
    Route::get('/turmas/{id}', [AlunoController::class, 'detalhesTurma'])->name('turmas.detalhes');
    Route::post('/entregar-trabalho/{id}', [AlunoController::class, 'entregarTrabalho']);
});
