<?php

use Illuminate\Database\Seeder;

class ConfigurationsTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configurations')->insert([
            'id'            => 1,
            'user_id'       => 1,
            'software_id'   => 1,
            'name'          => 'Test configuration',
            'content'       => 'test',
            'filename'      => 'filename',
            'path'          => 'path'
        ]);
    }
}
