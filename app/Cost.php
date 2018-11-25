<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    protected $fillable = [
        'date','account_number', 'comment','sum','site_id','supplier_id','cost_type_id',
    ];

    public function site(){
        return $this->belongsTo(Site::class, 'site_id','id');
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id','id');
    }
    public function cost_type(){
        return $this->belongsTo(Cost_type::class, 'cost_type_id','id');
    }

}
