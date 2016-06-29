<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
	public $fillable = ['name', 'votes'];

	public $timestamps = false;
    /**
     * @return mixed
     */
    public function poll()
    {
        return $this->belongsTo('App\Poll');
    }
}
