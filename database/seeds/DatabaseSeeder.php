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

        DB::table('answers')->insert([
            'title_th' => 'คำตอบ 1',
            'title_en' => 'answer 1',
            'question_id' => '1',
        ]);

        DB::table('answers')->insert([
            'title_th' => 'คำตอบ 2',
            'title_en' => 'answer 2',
            'question_id' => '1',
        ]);

        DB::table('choices')->insert([
            'image_name' => '4707834751504200977',
            'ext' => 'png',
            'title_th' => 'คำถามที่ 1',
            'title_en' => 'question number 1',
            'answer_id' => '1',
            'question_id' => '1',
            'order' => '1'
        ]);

        DB::table('choices')->insert([
            'image_name' => '2645627471504202252',
            'ext' => 'png',
            'title_th' => 'คำถามที่ 2',
            'title_en' => 'question number 2',
            'answer_id' => '2',
            'question_id' => '1',
            'order' => '2'
        ]);

        DB::table('questions')->insert([
            'cover_name' => '13232173611504200307',
            'cover_ext' => 'png',
            'title_th' => 'MQRI',
            'title_en' => 'MQRI',
            'background_color' => '#3c38ff',
        ]);
    }
}
