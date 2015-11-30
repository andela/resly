<?php

namespace Resly\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Resly\Restaurateur;
use Resly\Diner;
use Resly\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'Resly\Model' => 'Resly\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);

        $gate->define('authenticated', function ($user) {
            return $user instanceof User;
        });

        $gate->define('restaurateur-user', function ($user) {
            return $user->getRole() === 'restaurateur';
        });

        $gate->define('diner-user', function ($user) {
            return $user->getRole() === 'diner';
        });
    }
}
