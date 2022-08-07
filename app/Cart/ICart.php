<?php

namespace App\Cart;

interface ICart
{
    public function store();

    public function update();

    public function remove();

    public function destroy();
}
