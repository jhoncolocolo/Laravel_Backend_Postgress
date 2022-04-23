<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return  void
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     *
     * @return  void
     */
    public function register()
    {
        App::bind(
            'App\Repositories\User\UserRepositoryInterface',
            'App\Repositories\User\UserRepository'
        );
        App::bind(
            'App\Repositories\Permission\PermissionRepositoryInterface',
            'App\Repositories\Permission\PermissionRepository'
        );
        App::bind(
            'App\Repositories\Role\RoleRepositoryInterface',
            'App\Repositories\Role\RoleRepository'
        );
        App::bind(
            'App\Repositories\RoleUser\RoleUserRepositoryInterface',
            'App\Repositories\RoleUser\RoleUserRepository'
        );
        App::bind(
            'App\Repositories\PermissionRole\PermissionRoleRepositoryInterface',
            'App\Repositories\PermissionRole\PermissionRoleRepository'
        );
        App::bind(
            'App\Repositories\PermissionUser\PermissionUserRepositoryInterface',
            'App\Repositories\PermissionUser\PermissionUserRepository'
        );
        App::bind(
            'App\Repositories\Language\LanguageRepositoryInterface',
            'App\Repositories\Language\LanguageRepository'
        );
        App::bind(
            'App\Repositories\StepByLanguageOrFramework\StepByLanguageOrFrameworkRepositoryInterface',
            'App\Repositories\StepByLanguageOrFramework\StepByLanguageOrFrameworkRepository'
        );
    }
}