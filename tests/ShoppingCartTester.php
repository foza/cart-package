<?php

namespace Foza\Cart\Tests;

use Illuminate\Support\Collection;
use Foza\Cart\CartItem;
use Foza\Cart\Facades\ShoppingCart;
use Foza\Cart\ServiceProvider;

trait ShoppingCartTester
{
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Cart' => ShoppingCart::class,
        ];
    }

    /**
     * @param int $id
     * @param string $name
     * @param int $price
     * @param int $type
     * @param int $quantity
     *
     * @return CartItem
     */
    protected function addItemToCart(
        $id = 1,
        $name = 'iPhone 7',
        $price = 100,
        $type = 2,
        $quantity = 10
    )
    {
        return \Cart::add($id, $name, $price, $type, $quantity);
    }

    /**
     * @param int $amount
     *
     * @return Collection
     */
    protected function addItemsToCart($amount = 5)
    {
        $items = new Collection();

        foreach (range(1, $amount) as $id) {
            $items->push($this->addItemToCart($id));
        }

        return $items;
    }
}
