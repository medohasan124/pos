<?php

use Illuminate\Database\Seeder;
use App\Catigory ;
use App\User ;

use App\Models\Role ;
use App\Models\Permission ;
class CatigoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


    $cat_role = Role::create([
    'name' => 'catigory',
    'display_name' => 'small store', // optional
    'description' => 'catigory', // optional
]);



     $c = Permission::create([
 'name' => 'cat_c',
 'display_name' => 'Create Catigory', // optional
 'description' => 'catigory', // optional
 ]);

 $e = Permission::create([
 'name' => 'cat_e',
 'display_name' => 'Edit Catigory', // optional
 'description' => 'catigory', // optional
 ]);

 $u = Permission::create([
 'name' => 'cat_u',
 'display_name' => 'Update Catigory', // optional
 'description' => 'catigory', // optional
 ]);

 $d = Permission::create([
 'name' => 'cat_d',
 'display_name' => 'Delete Catigory', // optional
 'description' => 'catigory', // optional
 ]);

       $cat = Catigory::create([

            'name_en' => 'test 1' ,
            'name_ar' => 'تجربة'

        ]);

      $user = User::find(1) ;

$user->attachRole($cat_role);

$user->attachPermissions([$e, $u , $c , $d]);

    }
}
