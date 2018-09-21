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

        $gate->define('isAdmin',function ($user){
            return $user->permission->name == 'Admin';
        });

        $gate->define('isGuest',function ($user){
            return $user->permission->name == 'Guest';
        });
    }
}
