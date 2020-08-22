<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'name'     => 'Tok',
            'email'    => 'contato@tok.com',
            'password' => '123456'
        ]);
    }
}
