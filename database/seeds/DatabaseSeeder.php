<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	  $this->call(LaratrustSeeder::class);
          $this->call(UsersTableSeeder::class);
          $this->call(CatigoryTableSeeder::class);
          $this->call(ItemTableSeeder::class);
          $this->call(ClientTableSeeder::class);
          $this->call(settingTableSeeder::class);
         
         
       
    }
}
