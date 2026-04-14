<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;
Route::get('/', function () {
    // Vamos buscar os dados diretamente à View SQL que já criaste!
    $pacientes = DB::table('v_painel_medico')->get();

    return view('painel', ['pacientes' => $pacientes]);
});

// Página de Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    if (!Session::has('user_id')) {
        return redirect('/login');
    }
    
    $pacientes = DB::table('v_painel_medico')->get();
    return view('painel', ['pacientes' => $pacientes]);
});