<?php

namespace Foza\Cart\Tests;

use Illuminate\Support\Facades\Redis;
use Foza\Cart\Repositories\ShoppingCartRedisRepository;
use Orchestra\Testbench\TestCase;

class ShoppingCartRedisTest extends TestCase
{
    use ShoppingCartRepositoryTester;

    protected function getEnvironmentSetUp($app)
    {
        $config = $app['config'];

        $config->set(
            'shopping-cart.repository',
            ShoppingCartRedisRepository::class
        );

        $config->set('database.redis.client', 'predis');
    }

    protected function tearDown(): void
    {
        Redis::flushAll();

        parent::tearDown();
    }
}
