<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname' => 'Alice',
            'lastname' => 'Porebski',
            'email' => 'alice.porebski@eilco-ulco.fr',
            'password' => Hash::make('hyperbdd2021'),
            'validated_by_admin' => true,
            'role_id' => 1,
            'created_at' => Carbon::now()

        ]);
        //
    }
}
