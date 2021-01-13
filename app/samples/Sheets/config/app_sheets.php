<?php

declare(strict_types=1);

use App\Samples\Sheets\TPosts;

return [
    't_posts' => [
        'class' => TPosts::class,
        'column_config' => [
            'id' => [
                'primary' => true,
            ],
            'title' => [
                'required' => true,
                'db_migrator' => 'string',
                'elastic_migrator' => 'string',
            ],
        ],
    ],
];