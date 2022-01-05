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
    'description' => 'User is the Super of a given project', // optional
]);

$admin = Role::create([
    'name' => 'Admin',
    'display_name' => 'User Admins', // optional
    'description' => 'is allowed to manage and edit other users', // optional
]);


 $c = Permission::create([
 'name' => 'c',
 'display_name' => 'Create Users', // optional
 'description' => 'create new blog posts', // optional
 ]);

 $e = Permission::create([
 'name' => 'e',
 'display_name' => 'Edit Users', // optional
 'description' => 'edit existing users', // optional
 ]);

 $u = Permission::create([
 'name' => 'u',
 'display_name' => 'Update Users', // optional
 'description' => 'Update new blog posts', // optional
 ]);

 $d = Permission::create([
 'name' => 'd',
 'display_name' => 'Delete Users', // optional
 'description' => 'Delete existing users', // optional
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
