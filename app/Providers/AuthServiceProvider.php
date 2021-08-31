<?php

namespace App\Providers;

use App\Models\Clinic;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use PhpParser\Node\Expr\Cast\Object_;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('patient', function(Object $user) {
            return $user instanceof Patient;
        });
        Gate::define('clinic', function(Object $user) {
            return $user instanceof Clinic;
        });
        Gate::define('system_admin', function(Object $user) {
            return $user instanceof User;
        });

    }
}
