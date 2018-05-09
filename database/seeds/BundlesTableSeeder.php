<?php

use Illuminate\Database\Seeder;

class BundlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bundles')->insert([
            'id'        => 1,
            'name'      => 'Bundle 1',
            'user_id'   => 1
        ]);

        DB::table('bundle_datas')->insert([
            'bundle_id'         => 1,
            'software_id'       => 1,
            'configuration_id'  => 1
        ]);
    }
}
