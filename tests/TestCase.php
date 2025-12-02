<?php

namespace Imgenerate\LaravelFaker\Tests;

use Imgenerate\LaravelFaker\ImgenerateServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            ImgenerateServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Imgenerate' => \Imgenerate\LaravelFaker\Facades\Imgenerate::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('filesystems.default', 'local');
        $app['config']->set('filesystems.disks.local', [
            'driver' => 'local',
            'root' => storage_path('app'),
        ]);
    }
}

