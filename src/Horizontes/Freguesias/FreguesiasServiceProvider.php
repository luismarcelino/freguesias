<?php

namespace Horizontes\Freguesias;

use Illuminate\Support\ServiceProvider;

/**
 * FreguesiasServiceProvider
 *
 */

class FreguesiasServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
    * Bootstrap the application.
    *
    * @return void
    */
    public function boot()
    {
        // The publication files to publish
        $this->publishes([__DIR__ . '/../../config/config.php' => config_path('freguesias.php')]);

        // Append the country settings
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/config.php', 'freguesias'
        );
    }

    /**
     * Register everything.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFreguesias();
        $this->registerCommands();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function registerFreguesias()
    {
        $this->app->bind('freguesias', function($app)
        {
            return new Freguesias();
        });
    }

    /**
     * Register the artisan commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        $this->app['command.freguesias.migration'] = $this->app->share(function($app)
        {
            return new MigrationCommand($app);
        });

        $this->commands('command.freguesias.migration');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('freguesias');
    }
}
