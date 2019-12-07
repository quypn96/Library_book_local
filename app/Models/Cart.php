<?php

namespace App\Models;


class Cart
{
    public $items = [];

    public function __construct($listItems)
    {
        if ($listItems) {
            $this->items = $listItems;
        }
    }

    public function add($book, $id)
    {
        if (array_key_exists($id, $this->items)) {

            return false;
        } else {
            $this->items[$id] = $book->toArray();

            return true;
        }
    }

    public function removeItem($id)
    {
        if (array_key_exists($id, $this->items)) {
            unset($this->items[$id]);

            return true;
        } else {

            return false;
        }
    }
}
