<?php

use Illuminate\Database\Seeder;

class SoftwaresTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('softwares')->insert([
            'id'            => 1,
            'name'          => 'Notepad++',
            'version'       => '7.5.10',
            'vendor'        => 'Notepad++',
            'vendor_url'    => 'https://notepad-plus-plus.org',
            'comment'       => 'Notepad++ is a free (as in "free speech" and also as in "free beer") source code editor and Notepad replacement that supports several languages. Running in the MS Windows environment, its use is governed by GPL License.',
            'download_url'  => 'https://notepad-plus-plus.org/repository/7.x/7.5.1/npp.7.5.1.Installer.exe'
        ]);
    }
}
