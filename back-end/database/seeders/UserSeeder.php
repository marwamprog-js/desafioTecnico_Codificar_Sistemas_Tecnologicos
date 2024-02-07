<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'João Fernandez';
        $user->email = 'joao@teste.com.br';
        $user->password = bcrypt('1234');
        $user->save();
    }
}
