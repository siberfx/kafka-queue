<?php

namespace Siberfx\Kafka;

use Illuminate\Support\ServiceProvider;
use Siberfx\Kafka\Connector\KafkaConnector;

class KafkaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
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

    private function publish(): void
    {

        $config = [
            __DIR__ . '/../config' => config_path(),
        ];

        $this->publishes($config, 'config');

    }

    /**
     * Register the application services.
     */
    public function register(): void
    {

    }
}
