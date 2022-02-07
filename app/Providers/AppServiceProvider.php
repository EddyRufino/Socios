<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('admin', function (User $user) {
            return $user->admin_since == 1;
        });

        Gate::define('superAdmin', function (User $user) {
            return $user->name == 'Admin';
        });

        Blade::if('admin', function () {
            return optional(auth()->user())->can('admin');
        });

        Blade::if('superAdmin', function () {
            return optional(auth()->user())->can('superAdmin');
        });

        Blade::if('adminTemplate', function() {
            return request()->user()->hasRoles(['admin']);
        });

        Blade::if('canUpdate', function() {
            return request()->user()->hasRoles(['admin', 'superadmin', 'editor']);
        });

        Blade::if('canDelete', function() {
            return request()->user()->hasRoles(['superadmin']);
        });

        Blade::if('canPrint', function() {
            return request()->user()->hasRoles(['admin', 'superadmin', 'imprimir']);
        });

        Blade::if('canExport', function() {
            return request()->user()->hasRoles(['admin', 'superadmin', 'exportar']);
        });
    }
}
