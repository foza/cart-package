<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Shopping cart repository settings
    |--------------------------------------------------------------------------
    |
    | Here you can set which repository to use. Available repositories:
    | database and redis.
    |
    */

    'repository' => \Foza\Cart\Repositories\ShoppingCartDatabaseRepository::class,

    // 'repository' => \Foza\Cart\Repositories\ShoppingCartRedisRepository::class,

    /*
    |--------------------------------------------------------------------------
    | Shopping cart database settings
    |--------------------------------------------------------------------------
    |
    | Here you can set the connection that the package should use when
    | storing and restoring a cart. Only if database repository is used.
    |
    */

    'database' => [

        'connection' => null,

        'table' => 'shopping_cart',

    ],
];
