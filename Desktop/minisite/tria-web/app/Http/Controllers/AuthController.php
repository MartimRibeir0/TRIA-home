<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Procurar o utilizador na tua base de dados
        $user = DB::table('utilizadores')
                  ->where('email', $credentials['email'])
                  ->first();

        // Verificação manual (Nota: no teu SQL os hashes são exemplos. 
        // Se mudares para passwords reais, usa Hash::check)
        if ($user && $user->ativo == 1) {
            // Para o protótipo, vamos aceitar se a pass for igual ao hash de exemplo
            // Numa app real usarias: if (Hash::check($request->password, $user->password_hash))
            if ($request->password === 'password' || Hash::check($request->password, $user->password_hash)) {
                
                // Guardar dados básicos na sessão
                Session::put('user_id', $user->id);
                Session::put('user_nome', $user->nome);
                Session::put('user_role', $user->role);

                return redirect('/')->with('success', 'Bem-vindo, ' . $user->nome);
            }
        }

        return back()->withErrors(['email' => 'Credenciais inválidas ou conta inativa.']);
    }

    public function logout() {
        Session::flush();
        return redirect('/login');
    }
}