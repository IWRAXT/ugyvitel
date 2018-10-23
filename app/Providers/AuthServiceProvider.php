<?php

namespace App\Providers;

//use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];


//    public function boot()
//    {
//        $this->registerPolicies();
//
//        //
//    }

    public function boot (GateContract $gate){
        $this->registerPolicies($gate);

        $gate->define('isAdmin',function ($user){ //Joga van Cost, Incomes, Leader, Sites láthatóság
            return $user->permission->name == 'Admin';
        });

        $gate->define('isCosts',function ($user){
            return $user->permission->name == 'Costs handler';
        });
        $gate->define('isIncomes',function ($user){
            return $user->permission->name == 'Incomes handler';
        });
        $gate->define('isLeader',function ($user){      //Cost-Incomes statistic and employees láthatóság
            return $user->permission->name == 'Leader';
        });
        $gate->define('isSites',function ($user){
            return $user->permission->sites == 1;  //Kezelheti az összes telephelyet vagy sem
        });
    }
}
