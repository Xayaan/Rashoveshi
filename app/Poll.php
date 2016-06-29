<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
	public $fillable = ['title', 'desc'];
    /**
     * @return mixed
     */
    public function choices()
    {
        return $this->hasMany('App\Choice');
    }
}
