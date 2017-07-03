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

        DB::table('questions')->insert([
            'question_th' => 'คำถาม',
            'choice1_th' => 'ตัวเลือก 1',
            'choice2_th' => 'ตัวเลือก 2',
            'choice3_th' => 'ตัวเลือก 3',
            'choice4_th' => 'ตัวเลือก 4',
            'description_th' => 'คำอธิบาย',

            'question_en' => 'what ??',
            'choice1_en' => 'choice 1',
            'choice2_en' => 'choice 2',
            'choice3_en' => 'choice 3',
            'choice4_en' => 'choice 4',
            'description_en' => 'description',

            'question_vn' => 'Câu hỏi',
            'choice1_vn' => 'Lựa chọn 1',
            'choice2_vn' => 'Lựa chọn 2',
            'choice3_vn' => 'Lựa chọn 3',
            'choice4_vn' => 'Lựa chọn 4',
            'description_vn' => 'sự miêu tả',
            'order' => '1',
            'answer' => '1',
        ]);

        DB::table('questions')->insert([
            'question_th' => 'คำถาม 2',
            'choice1_th' => 'ตัวเลือก 1',
            'choice2_th' => 'ตัวเลือก 2',
            'choice3_th' => 'ตัวเลือก 3',
            'choice4_th' => 'ตัวเลือก 4',
            'description_th' => 'คำอธิบาย 2',

            'question_en' => 'what 2??',
            'choice1_en' => 'choice 1',
            'choice2_en' => 'choice 2',
            'choice3_en' => 'choice 3',
            'choice4_en' => 'choice 4',
            'description_en' => 'description 2',

            'question_vn' => 'Câu hỏi 2',
            'choice1_vn' => 'Lựa chọn 1',
            'choice2_vn' => 'Lựa chọn 2',
            'choice3_vn' => 'Lựa chọn 3',
            'choice4_vn' => 'Lựa chọn 4',
            'description_vn' => 'sự miêu tả 2',
            'order' => '1',
            'answer' => '3',
        ]);
    }
}
