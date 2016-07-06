<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metric extends Model
{
    protected $fillable = ['type'];

    protected $dates = ['created_at'];

    public function ad()
    {
        return $this->belongsTo('App\Advs');
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}
