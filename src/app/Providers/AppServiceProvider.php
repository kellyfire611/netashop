<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Auth\CustomUserProvider;
use App\Models\AclUser;
use App\Models\AclPermission;
use Illuminate\Support\Facades\Gate;
use App\Policies\ShopPostPolicy;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('vendor.pagination.bootstrap-5');
        Paginator::defaultSimpleView('vendor.pagination.simple-bootstrap-5');

        // Sử dụng CustomUserProvider để xác thực tài khoản
        $this->app->auth->provider('custom', function ($app, array $config) {
            return new CustomUserProvider($app['hash'], $config['model']);
        });

        // Định nghĩa các cổng kiểm tra dữ liệu
        // Gate::define('shop_posts::view', function(AclUser $user) {
        //     netaHasPermission($user, 'shop_posts::view');
        // });
        
        // Gate::define('shop_posts::create', [ShopPostPolicy::class, 'create']);
        // Gate::define('shop_posts::update', [ShopPostPolicy::class, 'update']);
        // Gate::define('shop_posts::delete', function(AclUser $user) {
        //     return netaHasPermission($user, 'shop_posts::delete');
        // });

        // Định nghĩa các gate liên quan về shop_categories
        

        $allPermissions = AclPermission::all();
        // dd($allPermissions);
        foreach($allPermissions as $permission) {

            Gate::define($permission->name, function(AclUser $user) use ($permission) {
                return netaHasPermission($user, $permission->name);
            });

        }
    }
}
