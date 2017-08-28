<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       	DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('1234'),
            'isAdmin' => true,
        ]);

        DB::table('users')->insert([
            'name' => 'user1',
            'email' => 'test@gmail.com',
            'password' => bcrypt('1234'),
            'isAdmin' => false,
        ]);
    }
}
