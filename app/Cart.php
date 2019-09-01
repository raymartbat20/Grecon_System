<?php

namespace App;


class Cart
{
    public $items = null;
    public $qty = 0;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart){
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item,$id,$qty){
        $storedItem = ['qty' => 0,
                       'price' => $item->price,
                       'item'=>$item];

            if($this->items){
                if (array_key_exists($id, $this->items)){
                    $storedItem = $this->items[$id];
                    $this->totalQty -= 1;
                }
            }
        $storedItem['qty'] += $qty;
        $this->totalQty += 1;
        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalPrice += $item->price * $qty;
    }

    public function reduceQty($id,$qty){
        if($qty > $this->items[$id]['qty'])
        {
            $qty = $this->items[$id]['qty'];
        }
        $this->items[$id]['qty'] -= $qty;
        $this->items[$id]['price'] -= ($this->items[$id]['item']['price'] * $qty);
        $this->totalPrice -= ($this->items[$id]['item']['price'] * $qty);

        if ($this->items[$id]['qty'] <= 0){
            unset($this->items[$id]);
            $this->totalQty -= 1;
        }
    }

    public function removeItem($id){
        $this->totalQty -= 1;
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }
}   