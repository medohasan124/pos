<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
class settings extends Model
{
     use Notifiable ;
    
    protected $fillable = [

    	'sitename_en' , 'sitename_ar' ,'email' ,'logo' , 'description' , 'phone1' ,'phone2'
    ];
}
