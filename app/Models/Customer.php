<?php

namespace App\Models;

use App\Models\Storable;

class Customer extends Storable
{
    public $id = self::PRIMARY_KEY;

    public $name = '';
}