<?php

namespace BaoPham\DynamoDb\Tests;

use BaoPham\DynamoDb\DynamoDbServiceProvider;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Orchestra\Testbench\TestCase;

/**
 * Class DynamoDbTestCase
 *
 * @package BaoPham\DynamoDb\Tests
 */
abstract class DynamoDbTestCase extends TestCase
{
    use DatabaseMigrations;

    protected function getPackageProviders($app)
    {
        return [DynamoDbServiceProvider::class];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('dynamodb.default', 'test');
        $app['config']->set('dynamodb.connections.test', [
            'credentials' => [
                'key' => 'dynamodb_local',
                'secret' => 'secret',
            ],
            'region' => 'test',
            'endpoint' => env('DYNAMODB_ENDPOINT', 'http://localhost:3000'),
        ]);
    }

    protected function defineDatabaseMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }
}
