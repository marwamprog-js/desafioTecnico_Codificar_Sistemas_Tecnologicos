<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request) {
        //Autenticação (email e senha)
        $credenciais = $request->all(['email', 'password']);

        $token = auth('api')->attempt($credenciais);

        if($token) { // Usuario autenticado com sucesso
            return response()->json(['token' => $token]);
        } else { // Erro de usuário ou senha 
            return response()->json(['erro' => 'Usuário ou senha inválido'], 403);
        }


        //retornar um JWT
        return 'Login';
    }

    public function logout() {
        return 'Logout';
    }
}
