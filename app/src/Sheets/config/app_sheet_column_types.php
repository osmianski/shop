<?php

declare(strict_types=1);

return [
    'table__id' => \App\Sheets\Sheets\Columns\Table\Id::class,
    'table__string' => \App\Sheets\Sheets\Columns\Table\String_::class,
    'table__string_option' => \App\Sheets\Sheets\Columns\Table\StringOption::class,
    'table__text' => \App\Sheets\Sheets\Columns\Table\Text::class,
    'table__bool' => \App\Sheets\Sheets\Columns\Table\Bool_::class,
    'table__price' => \App\Sheets\Sheets\Columns\Table\Price::class,
    'table__datetime' => \App\Sheets\Sheets\Columns\Table\DateTime::class,
    'table__file' => \App\Sheets\Sheets\Columns\Table\File::class,
    'table__files' => \App\Sheets\Sheets\Columns\Table\Files::class,
];