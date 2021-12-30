<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
	use SoftDeletes;
	
     protected $fillable = [
        'user_id','first_name','last_name','name','email','password','orignal_password','phone_no','address','is_admin','is_active',
    ];

}
