<?php

use Illuminate\Database\Seeder;
use App\Periode;

class PeriodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Periode::create([
        	'prodi_id' => 1,
        	'mulai' => '2018-07-28',
        	'berakhir' => '2018-07-28'
        ]);
        Periode::create([
        	'prodi_id' => 2,
        	'mulai' => '2018-07-29',
        	'berakhir' => '2018-07-29'
        ]);
        Periode::create([
        	'prodi_id' => 3,
        	'mulai' => '2018-07-30',
        	'berakhir' => '2018-07-30'
        ]);
        Periode::create([
        	'prodi_id' => 4,
        	'mulai' => '2018-07-31',
        	'berakhir' => '2018-07-31'
        ]);
        Periode::create([
        	'prodi_id' => 5,
        	'mulai' => '2018-08-01',
        	'berakhir' => '2018-08-01'
        ]);
    }
}
