<?php

namespace App\Sheets\Indexes\Columns;

use App\Sheets\Indexes\Index;
use App\Sheets\Sheets\Columns\Column as SheetColumn;
use App\Sheets\Sheets\Sheet;
use Osm\Core\Object_;

/**
 * @property string $name @required @part
 * @property string $type @required @part
 * @property Index $parent @required
 *
 * Computed:
 *
 * @property Sheet $sheet @required
 * @property SheetColumn $sheet_column @required
 */
class Column extends Object_
{
    protected function get_sheet(): Sheet {
        return $this->parent->parent;
    }

    protected function get_sheet_column(): SheetColumn {
        return $this->sheet->columns[$this->name];
    }
}