<?php

use App\Products\Products;
use App\Products\Search\ElasticSearchEngine;

return [
    'products' => [
        'class' => Products::class,
        'search_engine' => [
            'class' => ElasticSearchEngine::class,
        ],
    ],
];