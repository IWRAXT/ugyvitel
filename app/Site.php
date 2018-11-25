<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;




class Site extends Model
{
    protected $fillable = [
        'image', 'name', 'address', 'leader_id',
    ];

    public function leader()
    {
        return $this->belongsTo(Employee::class, 'leader_id', 'id');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function costs()
    {
        return $this->hasMany(Cost::class);
    }

    public function printEmployees()
    {
        //A telephelyen dolgoók listája
        $employees = $this->employees;
        $result = [];
        $j = 0;
        for ($i = 0, $iMax = count($employees); $i < $iMax; $i++) {
            $employee = $employees[$i];
            if ($employee->site_id == $this->id) {
                $result[$j] = $employee;
                $j++;
            }
        }
        return $result;
    }

    public function sumSiteCosts()
    {
        $costs = $this->costs;
        $sum = 0;
        $j = 0;
        for ($i = 0, $iMax = count($costs); $i < $iMax; $i++) {
            $cost = $costs[$i];
            $sum += $cost->sum;
            $j++;
        }

        return $sum;
    }

    public function sumCost_type()
    {
        //groupby + sum
        $sum = DB::table('costs')->join('cost_types', 'cost_types.id', '=', 'costs.cost_type_id')
            ->select('cost_types.name', 'site_id', DB::raw('SUM(sum) as sumsum'))
            ->where('site_id', $this->id)
            ->groupBy('cost_type_id')
            ->pluck('sumsum', 'cost_types.name');

        //Pluck "Ropi" => "444" string formátumban tér vissza

//        foreach($sum as $key => $value ){
//                $new[$key]=(int)$value;
//            } //Ebben a formában tömbnek érzékeli a keys() és a values() fg. a $sum-ot


        //Ezér használtam map-et ami végig iterál egy collection-ön, majd a transform-ot kellett használni mert azzal meg is lehet változtatni az értéket (int)$values
        $sum->transform(function ($value,$key){
            return (int)$value;
        });




        return $sum;

    }
}
