<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{

    public function login(Request $request) {
        
        $validate = [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];
    
        $feedback = [
            'required' => 'O campo :attribute é obrigatório',
            'email.email' => 'O campo e-mail é obrigatório',
            'password.min' => 'O campo Senha de ter no mínimo 8 caracteres',
        ];

        $request->validate($validate, $feedback);

        //Autenticação (email e senha)
        $credenciais = $request->all(['email', 'password']);


        $token = auth('api')->attempt($credenciais);
        $user = User::where('email', $request->email)->first();
        
        $userResponse = [
            "id" => $user->id,
            "name" => $user->name,
            "email" => $user->email
        ];
        
        if($token) { // Usuario autenticado com sucesso
            return response()->json([
                'token' => $token,
                'user' => $userResponse
            ]);
        } else { // Erro de usuário ou senha 
            return response()->json([
                'error' => 'Usuário ou senha inválido'
            ], 401);
        }

    }

    public function logout() {
        auth('api')->logout();
        return response()->json([
            'msg' => 'Logout foi realizado com sucesso!'
        ]);
    }

    public function me() {

        $userResponse = [
            "id" => auth()->user()->id,
            "name" => auth()->user()->name,
            "email" => auth()->user()->email
        ];

        return response()->json($userResponse);
    }

    public function refresh() {               
        $token = auth('api')->refresh();
        return response()->json(['token' => $token]);
    }
    
}
