<?php

namespace App\Providers;

use App\Bundle;
use App\Configuration;
use App\Policies\BundlePolicy;
use App\Policies\ConfigurationPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model'             => 'App\Policies\ModelPolicy',
        Configuration::class    => ConfigurationPolicy::class,
        Bundle::class           => BundlePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
