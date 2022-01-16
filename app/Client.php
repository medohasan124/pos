<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
class Client extends Model
{
    use Notifiable ;
    
    protected $fillable = [
		'username'  , 'number' , 'location' , 'email' ,
    ];




    
}
