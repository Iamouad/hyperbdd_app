<?php

namespace Database\Seeders;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       

        DB::table('users')->insert([
            'firstname'    => 'abir',
            'lastname'    => 'kfifat',
            'email'    => 'kfifat@gmail.com',
            'password'   =>  Hash::make('abir1'),
            'remember_token' =>  11,
            'role_id' => 2,
        ]);

        DB::table('users')->insert([
            'firstname'    => 'alae',
            'lastname'    => 'kfifat',
            'email'    => 'alae@gmail.com',
            'password'   =>  Hash::make('abir2'),
            'remember_token' =>  11,
            'role_id' => 2,
        ]);
    }
}
