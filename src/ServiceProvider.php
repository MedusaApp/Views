<?php
namespace PersonalityViews;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'personality');
        $this->publishes([
            __DIR__ . '/../resources/lang/en' => resource_path('/lang/vendor/cookieConsent/en'),
        ], 'core.lang');
    }
}