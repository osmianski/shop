<?php

namespace App\Products\Columns;

use Osm\Core\Object_;

/**
 * @property string $name @required @part
 */
class Column extends Object_
{
    public function pack(&$result, $value) {
        $result[$this->name] = $value;
    }

    public function validate($value) {
    }
}