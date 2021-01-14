<?php

declare(strict_types=1);

use App\Samples\Sheets\TPosts;

return [
    't_posts' => [
        'class' => TPosts::class,
        'column_config' => [
            'id' => [
                'type' => 'id',
            ],
            'title' => [
                'type' => 'string',
                'required' => true,
                //'elastic_migrator' => 'string',
            ],
        ],
    ],
];