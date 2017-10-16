<?php

namespace App\Models;

use App\Models\Storable;

class Product extends Storable
{
    public $id = self::PRIMARY_KEY;

    public $name = '';
}