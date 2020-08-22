<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();

        $user = User::create([
            'name'     => 'Tok',
            'email'    => 'contato@tok.com',
            'password' => bcrypt('123456')
        ]);

        \Bouncer::assign('master')->to($user);
    }
}
