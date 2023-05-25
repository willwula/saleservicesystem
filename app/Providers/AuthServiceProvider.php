<?php

namespace App\Providers;

use App\Models\BikeBrand;
use App\Models\BikeModel;
use App\Policies\BikeBrandPolicy;
use App\Policies\BikeModelPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        BikeBrand::class => BikeBrandPolicy::class,
        BikeModel::class => BikeModelPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
