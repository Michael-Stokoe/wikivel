<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';
    protected $webNamespace = 'App\Http\Controllers\Web';
    protected $adminNamespace = 'App\Http\Controllers\Admin';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapAllWikiRoutes();

        $this->mapAllAdminRoutes();

        $this->mapAllCommentRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    protected function mapAllCommentRoutes()
    {
        $this->mapCommentRoutes();
    }

    protected function mapCommentRoutes()
    {
        Route::middleware(['web', 'auth'])
            ->namespace($this->webNamespace)
            ->group(base_path('routes/wiki/comment.php'));
    }


    protected function mapAllWikiRoutes()
    {
        $this->mapWikiWebRoutes();
        $this->mapSpaceWebRoutes();
        $this->mapPageWebRoutes();
        $this->mapImageWebRoutes();
        $this->mapUserWebRoutes();
    }

    protected function mapAllAdminRoutes()
    {
        $this->mapWikiAdminRoutes();
        $this->mapSpaceAdminRoutes();
        $this->mapPageAdminRoutes();
        $this->mapImageAdminRoutes();
        $this->mapUserAdminRoutes();
    }


    // Web Routes
    protected function mapWikiWebRoutes()
    {
        Route::middleware(['web', 'auth'])
            ->namespace($this->webNamespace)
            ->group(base_path('routes/wiki/wiki.php'));
    }

    protected function mapSpaceWebRoutes()
    {
        Route::middleware(['web', 'auth'])
            ->namespace($this->webNamespace)
            ->group(base_path('routes/wiki/space.php'));
    }

    protected function mapPageWebRoutes()
    {
        Route::middleware(['web', 'auth'])
            ->namespace($this->webNamespace)
            ->group(base_path('routes/wiki/page.php'));
    }

    protected function mapImageWebRoutes()
    {
        Route::middleware(['web', 'auth'])
            ->namespace($this->webNamespace)
            ->group(base_path('routes/wiki/image.php'));
    }

    protected function mapUserWebRoutes()
    {
        Route::middleware(['web', 'auth'])
            ->namespace($this->webNamespace)
            ->group(base_path('routes/wiki/user.php'));
    }


    // Admin Routes
    protected function mapWikiAdminRoutes()
    {
        Route::middleware(['web', 'auth', 'auth.admin'])
            ->prefix('admin')
            ->as('admin.')
            ->namespace($this->adminNamespace)
            ->group(base_path('routes/admin/wiki.php'));
    }

    protected function mapSpaceAdminRoutes()
    {
        Route::middleware(['web', 'auth', 'auth.admin'])
            ->prefix('admin')
            ->as('admin.')
            ->namespace($this->adminNamespace)
            ->group(base_path('routes/admin/space.php'));
    }

    protected function mapPageAdminRoutes()
    {
        Route::middleware(['web', 'auth', 'auth.admin'])
            ->prefix('admin')
            ->as('admin.')
            ->namespace($this->adminNamespace)
            ->group(base_path('routes/admin/page.php'));
    }

    protected function mapImageAdminRoutes()
    {
        Route::middleware(['web', 'auth', 'auth.admin'])
            ->prefix('admin')
            ->as('admin.')
            ->namespace($this->adminNamespace)
            ->group(base_path('routes/admin/image.php'));
    }

    protected function mapUserAdminRoutes()
    {
        Route::middleware(['web', 'auth', 'auth.admin'])
            ->prefix('admin')
            ->as('admin.')
            ->namespace($this->adminNamespace)
            ->group(base_path('routes/admin/user.php'));
    }
}
