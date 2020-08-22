<?php

use Illuminate\Database\Seeder;

class AgamaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agamas')->insert([
            ['nama' => 'Hindu'],
            ['nama' => 'Islam'],
            ['nama' => 'Budha'],
            ['nama' => 'Kristen Protestan'],
            ['nama' => 'kristen Katolik'],
            ['nama' => 'Konghucu']
        ]);
    }
}
