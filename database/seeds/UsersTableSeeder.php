<?php

use Illuminate\Database\Seeder;
use App\User ;
use App\Models\Role ;
use App\Models\Permission ;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    
    //Rolse
$super_admin = Role::create([
    'name' => 'super_admin',
    'display_name' => 'Project Super admin', // optional
    'description' => 'user', // optional
]);

$admin = Role::create([
    'name' => 'Admin',
    'display_name' => 'User Admins', // optional
    'description' => 'user', // optional
]);


 $c = Permission::create([
 'name' => 'c',
 'display_name' => 'Create Users', // optional
 'description' => 'user', // optional
 ]);

 $e = Permission::create([
 'name' => 'e',
 'display_name' => 'Edit Users', // optional
 'description' => 'user', // optional
 ]);

 $u = Permission::create([
 'name' => 'u',
 'display_name' => 'Update Users', // optional
 'description' => 'user', // optional
 ]);

 $d = Permission::create([
 'name' => 'd',
 'display_name' => 'Delete Users', // optional
 'description' => 'user', // optional
 ]);


 $user = User::create([
  'first_name' => 'medo' ,
  'last_name' => 'hassan' ,
  'password' => bcrypt('123123'),
  'email' => 'medo@yahoo.com' ,
]);

$user->attachRole($super_admin);

$user->attachPermissions([$e, $u , $c , $d]);




 
    }
}
