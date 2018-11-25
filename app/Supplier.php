<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name','fiscal_number','address','webpage_address','contact_name','contact_title','contact_email','contact_phone_number'
    ];
    public function cost(){
        return $this->hasMany(Cost::class);
    }

}
