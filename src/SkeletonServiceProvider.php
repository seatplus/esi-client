<?php

namespace VendorName\Skeleton;

use Illuminate\Support\ServiceProvider;

class SkeletonServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Publish the JS & CSS,
        $this->addPublications();

        // Add routes
        /*$this->loadRoutesFrom(__DIR__ . '/Http/routes.php');*/

        //Add Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations/');

        // Add translations
        //$this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'web');
    }

    public function register()
    {
        $this->mergeConfigurations();
    }

    private function mergeConfigurations()
    {

        /*$this->mergeConfigFrom(
            __DIR__ . '/config/package.permissions.php', 'web.permissions'
        );*/
    }

    private function addPublications()
    {
        /*
         * to publish assets one can run:
         * php artisan vendor:publish --tag=srp --force
         * or use Laravel Mix to copy the folder to public repo of core.
         */
        /*$this->publishes([
            __DIR__ . '/resources/js' => resource_path('js'),
        ], 'srp');*/
    }
}
