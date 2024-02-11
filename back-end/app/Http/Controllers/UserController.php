<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function __construct(User $user) {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    public function alterarNome(Request $request) {

        try {

            $validacao = [
                'name' => 'required|min:5|max:15',
            ];
        
            $feedback = [
                'required' => 'O campo :attribute é obrigatório',
                'name.min' => 'O campo nome de ter no mínimo 5 caracteres',
                'name.max' => 'O campo nome de ter no máximo 15 caracteres',
            ];

            $request->validate($validacao, $feedback);

            $user = User::find(Auth()->user()->id);
            $user->name = $request->input('name');
            $user->save();
    
            return response()->json([
                'response' => 'ok',
                'user' => $user
            ], 200);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => 'INTERNAL_SERVER',
                'error' => $ex->getMessage()
            ], 500);
        }

    }

    public function alterarSenha(Request $request) {

        try {

            $validacao = [                
                'senha_anterior' => 'required|min:8',
                'nova_senha' => 'required|min:8',
            ];
        
            $feedback = [
                'required' => 'O campo :attribute é obrigatório',                
                'senha_anterior.min' => 'O campo senha anterior de ter no mínimo 8 caracteres',
                'nova_senha.min' => 'O campo nova senha de ter no mínimo 8 caracteres',
            ];

            $request->validate($validacao, $feedback);
           
            $senhaAnterior = $request->input('senha_anterior');
            $novaSenha = $request->input('nova_senha');

            $user = User::find(Auth()->user()->id);
                
            if(!\Hash::check($senhaAnterior, $user->password)) {
                return response()->json([
                    'response' => 'FORBEDDEN',
                    'error' => "A senha anterior esta diferente da senha cadastrada"
                ], 403);
            }
            
            $user->password = bcrypt($novaSenha);
            $user->save();
    
            return response()->json([
                'response' => 'ok',
                'user' => $user
            ], 200);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => 'INTERNAL_SERVER',
                'error' => $ex->getMessage()
            ], 500);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validação dos campos
        $request->validate($this->user->rules(), $this->user->feedback());
        
        try {

            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->save();
    
            return response()->json([
                'response' => 'CREATED',
                'user' => $user
            ], 201);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => 'INTERNAL_SERVER',
                'error' => $ex->getMessage()
            ], 500);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
