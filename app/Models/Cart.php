<?php

namespace App\Models;

class Cart
{
    public $items = null;
    public $totalQty;
    public $totalPrice;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    /**
     * Add item to cart
     */
    public function addItem($item, $id, $qty)
    {
        $storedItem = [
            'qty' => 0,
            'price' => $item->price,
            'item' => $item
        ];

        /**
         * if item already exist in cart
         */
        if ($this->items && array_key_exists($id, $this->items)) {
            $storedItem = $this->items[$id];
            $storedItem['qty'] += $qty;
            $storedItem['price'] = $item->price * $storedItem['qty'];
        } else {
            $storedItem['qty'] += $qty;
            $storedItem['price'] = $item->price * $storedItem['qty'];
        }

        $this->items[$id] = $storedItem;
        $this->totalQty += $qty;
        $this->totalPrice += $item->price * $qty;
    }

    /**
     * update cart quantity
     */
    public function update($id, $item, $qty)
    {
        $updatedItem = [
            'qty' => $qty,
            'price' => $item->price,
            'item' => $item
        ];

        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $updatedItem = $this->items[$id];
            }
        }

        $updatedItem['price'] = $item->price * $updatedItem['qty'];

        $this->items[$id] = $updatedItem;

        $this->totalQty += $updatedItem['qty'];
        $this->totalPrice += $updatedItem['price'];
    }


    /**
     * remove items from cart
     */
    public function remove($id)
    {
        if (array_key_exists($id, $this->items)) {
            $this->totalQty -= $this->items[$id]['qty'];
            $this->totalPrice -= $this->items[$id]['price'];

            unset($this->items[$id]);
        }
    }
}
