<?php

declare(strict_types=1);

namespace App\Elastic;

use Elasticsearch\Client;
use Osm\Core\Object_;

/**
 * Constructor parameters:
 *
 * @property Cluster $parent @required
 * @property string $name @required @part
 *
 * Computed:
 *
 * @property string $prefixed_name @required
 *
 * Dependencies:
 *
 * @property Client $client @required
 */
class Index extends Object_
{
    /** @noinspection PhpUnused */
    protected function get_client(): Client {
        return $this->parent->client;
    }

    /** @noinspection PhpUnused */
    protected function get_prefixed_name(): string {
        return "{$this->parent->prefix}__{$this->name}";
    }

    /**
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/indices-exists.html
     *
     * @param array $params
     * @return bool
     */
    public function exists(array $params = []): bool {
        return $this->client->indices()->exists($this->addName($params));
    }

    /**
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/indices-create-index.html
     *
     * @param array $params
     */
    public function create(array $params = []): void {
        $this->client->indices()->create($this->addName($params));
    }

    /**
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/indices-delete-index.html
     *
     * @param array $params
     */
    public function delete(array $params = []): void {
        $this->client->indices()->delete($this->addName($params));
    }

    protected function addName(array $params): array {
        $params['index'] = $this->prefixed_name;

        return $params;
    }

}