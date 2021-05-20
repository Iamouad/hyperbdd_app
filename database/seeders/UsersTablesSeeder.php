<?php

namespace Database\Seeders;
use DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       

        // DB::table('users')->insert([
        //     'firstname'    => 'abir',
        //     'lastname'    => 'kfifat',
        //     'email'    => 'kfifat@gmail.com',
        //     'password'   =>  Hash::make('abir1'),
        //     'created_at' =>  now(),
        //     'role_id' => 3,
        // ]);

        // DB::table('users')->insert([
        //     'firstname'    => 'alae',
        //     'lastname'    => 'kfifat',
        //     'email'    => 'alae@gmail.com',
        //     'password'   =>  Hash::make('abir2'),
        //     'created_at' =>  now(),
        //     'role_id' => 3,
        // ]);
    }
}
