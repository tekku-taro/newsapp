<?php

use Illuminate\Database\Seeder;
use App\Folder;
use App\User;
use Illuminate\Support\Facades\Hash;

class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $folders = [
            '一時フォルダ','趣味','仕事'
        ];

        factory(App\Folder::class, 5)->create();
        // User::create([
        //     'name'=>'taro','email'=>'taro@gmail.com',
        //     'password'=> Hash::make('password'),'note'=>'test'
        // ])->each(function ($user) use ($folders) {
        //     foreach ($folders as $value) {
        //         $user->folders()->create(['name'=>$value]);
        //     }
        // });
    }
}
