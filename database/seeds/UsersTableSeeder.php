<?php

use Illuminate\Database\Seeder;
use App\User ;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $user = User::create([
       	'first_name' => 'super' ,
       	'last_name' => 'admin' ,
       	'email' => 'admin@yahoo.com' ,
       	'password' => bcrypt('123123') 
       ]);

       $user->attachRole('super_admin');
    }
}
