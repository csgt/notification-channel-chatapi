<?php
namespace NotificationChannels\Chatapi;

use Illuminate\Support\ServiceProvider;

class ChatapiProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->when(ChatapiChannel::class)
            ->needs(Chatapi::class)
            ->give(function () {
                return new Chatapi(
                    $this->app->make(ChatapiConfig::class)
                );
            });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->bind(ChatapiConfig::class, function () {
            return new ChatapiConfig($this->app['config']['services.chatapi']);
        });
    }
}
