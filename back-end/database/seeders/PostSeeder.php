<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::where('email', 'joao@teste.com.br')->first();
        
        $post = new Post();
        $post->post = 'Para Jean Paul Prates, o teto tornou-se uma espécie de "bezerro de ouro", ao passo que há uma "demonização do gasto social"';
        $post->user_id = $user1->id;
        $post->save();
        
        $post = new Post();
        $post->post = '"A solução divina" do limite de despesas "já há muito foi profanada pelos próprios liberais do governo"';
        $post->user_id = $user1->id;
        $post->save();
        
        $post = new Post();
        $post->post = 'Dá uma olhada nessa matéria: https://www12.senado.leg.br/noticias/materias/2022/10/11/jean-paul-propoe-repensar-bezerro-de-ouro-do-liberalismo-economico';
        $post->user_id = $user1->id;
        $post->save();

        $user2 = User::where('email', 'vanessa@teste.com.br')->first();

        $post = new Post();
        $post->post = 'O liberalismo econômico surgiu quando os Estados Nacionais estavam se constituindo.';
        $post->user_id = $user2->id;
        $post->save();

        $post = new Post();
        $post->post = 'Dá uma olhada nessa matéria: https://jornal.usp.br/artigos/muito-ja-se-sabe-mas-ainda-ha-muito-por-saber/';
        $post->user_id = $user2->id;
        $post->save();

        $post = new Post();
        $post->post = 'Cabe ao Estado, no liberalismo, a manutenção da ordem, a preservação da paz e a proteção à propriedade privada.';
        $post->user_id = $user2->id;
        $post->save();

    }
}
