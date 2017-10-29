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
        $this->call([
            UsersTableDataSeeder::class,
            SoftwaresTableDataSeeder::class,
            ConfigurationsTableDataSeeder::class
        ]);
    }
}