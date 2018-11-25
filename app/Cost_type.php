<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cost_type extends Model
{
    protected $fillable = [
        'name','group'
    ];

    public function costs(){
        return $this->hasMany(Cost::class);
    }

    //Össze lehet hasonlítani, hogy mennyi chips és Ropi
//    public function sum(){
//        $summary=0;
//        $costs[] = $this->costs();
//        for ($i=0;$i<count($costs);$i++){
//            $summary+=$costs[$i]->sum;
//        }
//        return $summary;
//    }

}
