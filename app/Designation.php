<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User as User;

class Designation extends Model
{
    protected $table = 'designations';

    protected $fillable = [
    	'name'			,
    	'slug'			,
    	'description '	,
    ];

    // public function users(){
    // 	return $this->hasMany('App\User')
    // }

}
