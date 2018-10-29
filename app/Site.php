<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = [
        'image','name', 'address','leader_id',
    ];

    public function leader(){
        return $this->belongsTo(Employee::class, 'leader_id','id');
    }

    public function employees(){
        return $this->hasMany(Employee::class);
    }

    public function printEmployees()
    {
        //A telephelyen dolgoók listája
        $employees = $this->employees;
        $result = [];
        $j=0;
        for ($i = 0, $iMax = count($employees); $i < $iMax; $i++) {
            $employee = $employees[$i];
            if($employee->site_id==$this->id){
                $result[$j] = $employee;
                $j++;
            }

        }

        return $result;
    }

}
