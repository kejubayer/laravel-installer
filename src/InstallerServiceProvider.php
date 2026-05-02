<?php

namespace Kejubayer\Installer;

use Illuminate\Support\ServiceProvider;
use Kejubayer\Installer\Http\Middleware\RedirectIfInstalled;
use Kejubayer\Installer\Http\Middleware\RedirectIfNotInstalled;

class InstallerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/installer.php', 'installer');
    }

    public function boot(): void
    {
        $this->app['router']->aliasMiddleware('installer.not_installed', RedirectIfInstalled::class);
        $this->app['router']->aliasMiddleware('installer.installed', RedirectIfNotInstalled::class);

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'installer');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/installer'),
        ], 'installer-views');

        $this->publishes([
            __DIR__ . '/../config/installer.php' => config_path('installer.php'),
        ], 'installer-config');
    }
}
