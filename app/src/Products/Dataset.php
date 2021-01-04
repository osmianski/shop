<?php

namespace App\Products;

use Illuminate\Support\Collection;
use Osm\Core\Object_;

class Dataset extends Object_
{
    public Collection $rows;
}