<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart
{
    public $items       = null;
    public $totalQty    = 0;
    public $totalPrice  = 0;

    public function _construct($oldCart)
    {
        # code...
        if ($oldCart) {
            # code...
            $this->items        = $oldCart->items;
            $this->totalQty     = $oldCart->totalQty;
            $this->totalPrice   = $oldCart->totalPrice;
        }
    }

    public function add($item, $id)
    {
        # code...
        $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];

        if ($this->items) {
            # code...
            if (array_key_exists($id, $this->items)) {
                # code...
                $storedItem = $this->items[$id];
            }
        }

        $storedItem['qty']++;
        $storedItem['price']    = $item->price * $storedItem['qty'];
        
        $this->items[$id]       = $storedItem;

        $this->totalQty++;
        $this->totalPrice   += $item->price;
    }
}
