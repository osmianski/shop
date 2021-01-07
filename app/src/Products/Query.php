<?php

namespace App\Products;

use Osm\Core\Object_;

class Query extends Object_
{
    public string $search;

    /**
     * @var string[]
     */
    public array $columns = [];

    /**
     * @var string[]
     */
    public array $facets = [];

    /**
     * @var string[]
     */
    public array $formula_filters = [];

    public function search(string $text): static {
        $this->search = $text;
        return $this;
    }

    public function select(string|array ...$columns): static {
        $this->columns = array_merge($this->columns, $columns);
        return $this;
    }

    public function value(string $column): mixed {
        return $this->first($column)?->$column;
    }

    public function first(string|array ...$columns): ?object {
        return $this->get(...$columns)->rows[0] ?? null;
    }

    public function get(string|array ...$columns): Dataset {
        $this->select(...$columns);

        return Runner::run($this);
    }



}