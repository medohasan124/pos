<?php

use Illuminate\Database\Seeder;
use App\Client ;
use App\User ;
use App\Models\Role ;
use App\Models\Permission ;
class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    $cat_role = Role::create([
    'name' => 'client',
    'display_name' => 'small client', // optional
    'description' => 'client', // optional
]);



     $c = Permission::create([
 'name' => 'client_c',
 'display_name' => 'Create client', // optional
 'description' => 'client', // optional
 ]);

 $e = Permission::create([
 'name' => 'client_e',
 'display_name' => 'Edit client', // optional
 'description' => 'client', // optional
 ]);

 $u = Permission::create([
 'name' => 'client_u',
 'display_name' => 'Update client', // optional
 'description' => 'client', // optional
 ]);

 $d = Permission::create([
 'name' => 'client_d',
 'display_name' => 'Delete client', // optional
 'description' => 'client', // optional
 ]);

       $client = Client::create([
            'username' => 'client test' ,
            'number' => '12345679' ,
            'location' => 'this is a small location for test' ,
            'email' => 'test@yahoo.com',

        ]);

      $user = User::find(1) ;

$user->attachRole($cat_role);

$user->attachPermissions([$e, $u , $c , $d]);
    }
}
