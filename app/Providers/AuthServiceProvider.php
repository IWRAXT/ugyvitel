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

    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('isAdmin', function ($user) { //Joga van Cost, Incomes, Leader, Sites láthatóság
            return $user->permission->name == 'Admin';
        });

        $gate->define('isDirectorateLeader', function ($user) {
            return $user->permission->name == 'Directorate Leader';
        });

        $gate->define('isCosts', function ($user) {
            return $user->permission->id == 6 ||$user->permission->id == 7;
        });
        $gate->define('isIncomes', function ($user) {

            return $user->permission->id == 4 || $user->permission->id == 5;


        });
        $gate->define('isLeader', function ($user) {      //Cost-Incomes statistic and employees láthatóság
            return $user->permission->id == 3;
        });
        $gate->define('isSites', function ($user) {
            return $user->permission->sites == 1;  //Kezelheti az összes telephelyet vagy sem
        });
    }
}
