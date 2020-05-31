<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 3)->create();
        App\User::create([
            'name'=>'taro',
            'email'=>'taro@gmail.com',
            'password'=> Hash::make('password'),
            'note'=>'test',
            'comment_to_public'=>true,
        ]);
    }
}
