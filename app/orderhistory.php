<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
class orderhistory extends Model
{
	   use Notifiable ;
    
    protected $fillable = [

  
    'user_id','client_id' ,'item_id' , 'item_count' ,'order_id' ,  'price' , 'active'

      ];
}
