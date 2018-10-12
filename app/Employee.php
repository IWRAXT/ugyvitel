<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable=[
        'last_name',
        'first_name',
        'born',
        'image',
        'address',
        'phone_number',
        'month_salary',
        'definite_employment',
        'recruitment_date',
        'comment',
        'principal_id',
        'user_id',
        'site_id',
    ];


    public function subalterns(){
        return $this->hasMany(Employee::class, 'principal_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function principal(){
        return $this->belongsTo(Employee::class, 'principal_id', 'id');
    }

    public function site(){
        return $this->belongsTo(Site::class);
    }

    public function printSubalterns()
    {
        $subalterns = $this->subalterns;
        $result = [];

        for ($i = 0, $iMax = count($subalterns); $i < $iMax; $i++) {
//            /** @var Person $beosztott */
            $beosztott = $subalterns[$i];

            $result[$beosztott->last_name] = $beosztott->printSubalterns();
        }

        return $result;
    }
}
