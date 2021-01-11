<?php

declare(strict_types=1);

use App\Sheets\ColumnDbMigrators;

return [
    'string' => ColumnDbMigrators\String_::class,
    'text' => ColumnDbMigrators\Text::class,
    'bool' => ColumnDbMigrators\Bool_::class,
    'price' => ColumnDbMigrators\Price::class,
    'datetime' => ColumnDbMigrators\DateTime::class,
    'file' => ColumnDbMigrators\File::class,
    'files' => ColumnDbMigrators\Files::class,
];