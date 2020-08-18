<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserTableSeeder::class);
        $this->call(AdminTableSeeder::class);
        $this->call(AgamaTableSeeder::class);
        $this->call(AngkatanTableSeeder::class);
        $this->call(GolonganDarahTableSeeder::class);
        $this->call(JenisKelaminTableSeeder::class);
        $this->call(ProgramStudiTableSeeder::class);
        $this->call(PeriodeTableSeeder::class);
        Model::reguard();
    }
}
