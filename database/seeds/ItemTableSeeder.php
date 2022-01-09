<?php

use Illuminate\Database\Seeder;
use App\items ;
use App\Models\Role ;
use App\Models\Permission ;
use App\User ;
class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            
    $cat_role = Role::create([
    'name' => 'item',
    'display_name' => 'small store', // optional
    'description' => 'catigory', // optional
]);



     $c = Permission::create([
 'name' => 'item_c',
 'display_name' => 'Create item', // optional
 'description' => 'item', // optional
 ]);

 $e = Permission::create([
 'name' => 'item_e',
 'display_name' => 'Edit item', // optional
 'description' => 'item', // optional
 ]);

 $u = Permission::create([
 'name' => 'item_u',
 'display_name' => 'Update item', // optional
 'description' => 'item', // optional
 ]);

 $d = Permission::create([
 'name' => 'item_d',
 'display_name' => 'Delete item', // optional
 'description' => 'item', // optional
 ]);

       $item =  items::create([
            'name_en' => 'test 1' ,
            'name_ar' => 'تجربة 2' ,
             'cat_id' => 1,
             'price' => 5.50 ,
              'image' => 'default.png',
              'description' => 'this is a small description for Item'

        ]);

       $item =  items::create([
            'name_en' => 'test 2' ,
            'name_ar' => 'تجربة' ,
             'cat_id' => 1,
             'price' => 5.50 ,
              'image' => 'default.png',
              'description' => 'this is a small description for Item'

        ]);

        $user = User::find(1) ;

$user->attachRole($cat_role);

$user->attachPermissions([$e, $u , $c , $d]);





    }
}

