<?php

namespace Siberfx\Kafka;

use Illuminate\Support\ServiceProvider;
use Siberfx\Kafka\Connector\KafkaConnector;

class KafkaServiceProvider extends ServiceProvider
{
    protected $defer = false;

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            // publish config file
            $this->publish();
        }

        $manager = $this->app['queue'];

        $manager->addConnector('kafka', function () {
            return new KafkaConnector;
        });
    }

    private function publish()
    {

        $config = [
            __DIR__ . '/../config' => config_path(),
        ];

        $this->publishes($config, 'config');

    }

    /**
     * Register the application services.
     */
    public function register()
    {

    }
}
