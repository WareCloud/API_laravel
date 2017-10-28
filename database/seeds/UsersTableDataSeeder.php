<?php

use Illuminate\Database\Seeder;

class UsersTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id'        => 1,
            'login'     => 'admin',
            'password'  => password_hash('admin', PASSWORD_BCRYPT, ['cost' => 12])
        ]);
    }
}
