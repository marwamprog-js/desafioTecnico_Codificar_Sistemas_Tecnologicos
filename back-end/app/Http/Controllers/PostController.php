<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\dto\post\PostResponseDTO;

class PostController extends Controller
{

    public function __construct(Post $post) {
        $this->post = $post;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $posts = Post::with(['user'])->get();
            $postResponse = [];
    
            if($posts === null) {
                return response()->json([
                    'status' => 'NOT_FOUND',
                    'error' => 'Nenhum post cadastro'
                ], 404);
            }

            foreach ($posts as $post) {
                $data = $post->created_at;
                $data = date('d/m/Y H:i:s', strtotime($data)); 
                
                $postResponse[] = [
                    "id" => $post->id,
                    "post" => $post->post,
                    "created_at" => $data,
                    "user" => $post->user->name
                ];
            }
    
            return response()->json([
                'status' => 'OK',
                'posts' => $postResponse
            ]);

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
        try {
            $request->validate($this->post->rules(), $this->post->feedback());
    
            $post = new Post();
            $post->post = $request->input('post');
            $post->user_id = auth()->user()->id;
            $post->save();
    
            return response()->json([
                'status' => 'NO_CONTENT',
                'post' => $post
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
    public function showPorIdLogado($id)
    {
        try {
            $posts = Post::with(['user'])->where('user_id', $id)->get();
            $postResponse = [];
   
            if($posts === null) {
                return response()->json([
                    'status' => 'NOT_FOUND',
                    'error' => 'Usuário ainda não publicou posts'
                ], 404);
            }

            if($id != auth()->user()->id) {
                return response()->json([
                    'status' => 'FORBIDDEN',
                    'error' => 'Permissão para ver post negada'
                ], 403);
            }

            foreach ($posts as $post) {
                $data = $post->created_at;
                $data = date('d/m/Y H:i:s', strtotime($data)); 
                
                $postResponse[] = [
                    "id" => $post->id,
                    "post" => $post->post,
                    "created_at" => $data,
                    "user" => [
                        "id" => $post->user->id,
                        "name" => $post->user->name
                    ]
                ];
            }

    
            return response()->json([
                'status' => 'OK',
                'posts' => $postResponse
            ]);

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
        try {
            $post = Post::with(['user'])->find($id);
    
            if($post === null) {
                return response()->json([
                    'status' => 'NOT_FOUND',
                    'error' => 'Post não localizado. Favor informar outro código'
                ], 404);
            }

            if($post->user_id != auth()->user()->id) {
                return response()->json([
                    'status' => 'FORBIDDEN',
                    'error' => 'Permissão para ver post negada'
                ], 403);
            }
    
            return response()->json([
                'status' => 'OK',
                'post' => $post
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => 'INTERNAL_SERVER',
                'error' => $ex->getMessage()
            ], 500);
        }
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
        try {
            $request->validate($this->post->rules(), $this->post->feedback());

            $post = Post::find($id);
    
            if($post === null) {
                return response()->json([
                    'status' => 'NOT_FOUND',
                    'error' => 'Post não localizado. Favor informar outro código'
                ], 404);
            }

            if($post->user_id != auth()->user()->id) {
                return response()->json([
                    'status' => 'FORBIDDEN',
                    'error' => 'Permissão para atualizar post negada'
                ], 403);
            }
            
            $post->post = $request->input('post');
            $post->save();
    
            return response()->json([
                'status' => 'NO_CONTENT',
                'post' => $post
            ], 201);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => 'INTERNAL_SERVER',
                'error' => $ex->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $post = Post::find($id);
    
            if($post === null) {
                return response()->json([
                    'status' => 'NOT_FOUND',
                    'error' => 'Post não localizado. Favor informar outro código'
                ], 404);
            }
    
            if($post->user_id != auth()->user()->id) {
                return response()->json([
                    'status' => 'FORBIDDEN',
                    'error' => 'Permissão para excluir post negada'
                ], 403);
            }
    
            $post->delete();

            return response()->json([
                'status' => 'NO_CONTENT',
                'msg' => 'Deletado com sucesso'
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'INTERNAL_SERVER',
                'error' => $ex->getMessage()
            ], 500);
        }
    }
}
