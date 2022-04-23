<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\User\UserService;
use App\Services\Permission\PermissionService;
use App\Services\Role\RoleService;
use App\Services\RoleUser\RoleUserService;
use App\Services\PermissionRole\PermissionRoleService;
use App\Services\PermissionUser\PermissionUserService;
use App\Services\Language\LanguageService;
use App\Services\General\GeneralService;
use App\Services\StepByLanguageOrFramework\StepByLanguageOrFrameworkService;

class GeneralServiceProvider extends ServiceProvider
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
        $this->app->bind('User', function () {
            return new UserService();
        });
        $this->app->bind('Permission', function () {
            return new PermissionService();
        });
        $this->app->bind('Role', function () {
            return new RoleService();
        });
        $this->app->bind('RoleUser', function () {
            return new RoleUserService();
        });
        $this->app->bind('PermissionRole', function () {
            return new PermissionRoleService();
        });
        $this->app->bind('PermissionUser', function () {
            return new PermissionUserService();
        });
        $this->app->bind('Language', function () {
            return new LanguageService();
        });
        $this->app->bind('StepByLanguageOrFramework', function () {
            return new StepByLanguageOrFrameworkService();
        });
        $this->app->bind('General', function () {
            return new GeneralService();
        });
    }
}