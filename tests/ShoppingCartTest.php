<?php

namespace Panda\Cart\Tests;

use Illuminate\Support\Collection;
use Panda\Cart\Coupons\FixedDiscountCoupon;
use Panda\Cart\Coupons\PercentDiscountCoupon;
use Orchestra\Testbench\TestCase;

class ShoppingCartTest extends TestCase
{
    use ShoppingCartTester;

    public function testAddItemToCart()
    {
        $this->addItemToCart();

        $this->assertEquals(1, \Cart::count());

        $this->addItemToCart(2);

        $this->assertEquals(2, \Cart::count());
    }

    public function testRemoveItemFromCart()
    {
        $items = $this->addItemsToCart();

        \Cart::remove($items[2]->getUniqueId());

        $this->assertEquals(4, \Cart::count());
    }

    public function testUpdateQuantity()
    {
        $cartItem = $this->addItemToCart(1, 'iPhone 7', 100, 5);
        \Cart::setQuantity($cartItem->getUniqueId(), 10);

        $this->assertEquals(10, \Cart::get($cartItem->getUniqueId())->quantity);
    }

    public function testClearCart()
    {
        $this->addItemsToCart();

        \Cart::clear();

        $this->assertEquals(0, \Cart::count());
    }

    public function testGetTotal()
    {
        $this->addItemsToCart();

        $this->assertEquals(5000, \Cart::getTotal());
    }

    public function testGetTotalWithCoupons()
    {
        $this->addItemToCart();

        \Cart::addCoupon(new FixedDiscountCoupon('fixed coupon', 300));
        \Cart::addCoupon(new PercentDiscountCoupon('percent coupon', 0.05));

        $this->assertEquals(1000 - 300 - 1000 * 0.05, \Cart::getTotalWithCoupons());
    }

    public function testContent()
    {
        $this->addItemsToCart();

        $content = \Cart::content();

        $this->assertEquals(5, $content->count());
        $this->assertInstanceOf(Collection::class, $content);
    }
}
