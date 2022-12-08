<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        // ADMIN == User, Kategori
        // STAFF == Kategori


        //validasi Role Admin
        //Manage User
        Gate::define('manage-users', function ($user) {
            //count() + array_intersect mengecek apakah $user->roles itu memiliki satu role atau beberapa role
            // json_decode pada $user-roles : karena $user->roles bertipe data JSON STRING
            //sehingga perlu menggunakan json_decode muntuk mengubahnya mejadi Array PHP
            return count(array_intersect(["ADMIN"], json_decode($user->roles)));
        });

        Gate::define('manage-staff', function ($user) {

            return count(array_intersect(["STAFF"], json_decode($user->roles)));
        });

        // manage category
        Gate::define('manage-categories', function ($user) {

            return count(array_intersect(["ADMIN", "STAFF"], json_decode($user->roles)));
        });

        //users
        Gate::define('manage-guest', function ($user) {
            return count(array_intersect(["ADMIN", "STAFF", "USER"], json_decode($user->roles)));
        });
    }
}
