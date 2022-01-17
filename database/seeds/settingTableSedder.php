<?php

use Illuminate\Database\Seeder;
use App\settings ;
class settingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        settings::create([

        	'sitename_en' => 'TEST POS',
        	'sitename_ar' => 'تجرية',
        	'email' => 'test@yahoo.com',
        	'logo' => 'default.png',
        	'description' => 'this is a test description',
        	'phone1' => '0100000000000',
        	'phone2' => '0100000000000',

        ]);
    }
}
