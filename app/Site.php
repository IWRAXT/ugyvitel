<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = [
        'image','name', 'address', 'leader', 'employee_id'
    ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
