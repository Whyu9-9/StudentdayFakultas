<?php

use Illuminate\Database\Seeder;

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
            [
                'nim' => '1605551033',
                'password' => '$2y$10$EuWXEPoLh1JqOVu1jWWYD.fBK84fh0qyKiArQ/6NHv6GDCD8VlPtK', // 111111
                'nama' => 'I Gede Agus Pradipta',
                'program_studi' => 5,
                'jenis_kelamin' => 1,
                'created_at' => date('Y-m-d H:i:s'), 
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ]);
    }
}
