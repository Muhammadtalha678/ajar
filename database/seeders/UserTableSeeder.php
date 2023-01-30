<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
         'name' => 'Admin',
         'email' => 'admin@example.com',
         'password' => bcrypt('password'),
         'role' => 'admin',
     ]);

	    // DB::table('users')->insert([
	    //     'name' => 'User',
	    //     'email' => 'user@example.com',
	    //     'password' => bcrypt('password'),
	    //     'role' => 'user',
	    // ]);
    }
}
