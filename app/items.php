<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
class items extends Model
{
    use Notifiable ;
    
    protected $fillable = [

    	'name_en' , 'name_ar' ,'cat_id' ,'price' , 'image' ,'description'
    ];
}
