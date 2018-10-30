<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cost_type extends Model
{
    protected $fillable = [
        'id','name','group'
    ];

    public function cost(){
        return $this->hasMany(Cost::class);
    }
}
