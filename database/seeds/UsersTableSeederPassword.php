<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeederPassword extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::all();
        foreach ($user as $u){
            $u->update([
                'password' => bcrypt($u->nim)
            ]);
        }
    }
}
