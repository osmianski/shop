<?php

declare(strict_types=1);

namespace App\Elastic;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Osm\Core\App;
use Osm\Core\Object_;
use Osm\Framework\Logging\Logs;
use Osm\Framework\Settings\Settings;

/**
 * Constructor parameters:
 *
 * @property string $prefix @required @part
 *
 * Computed:
 *
 * @property Client $client @required
 *
 * Dependencies:
 *
 * @property Settings $settings @required
 * @property Logs $logs @required
 */
class Cluster extends Object_
{
    /** @noinspection PhpUnused */
    protected function get_client(): Client {
        $builder = ClientBuilder::create();

        if ($this->settings->elastic_hosts) {
            $builder->setHosts($this->settings->elastic_hosts);
        }

        if ($this->settings->elastic_cloud_id) {
            $builder->setElasticCloudId($this->settings->elastic_cloud_id);

            if ($this->settings->elastic_cloud_api_id) {
                $builder->setApiKey(
                    $this->settings->elastic_cloud_api_id,
                    $this->settings->elastic_cloud_api_key);
            }
            elseif($this->settings->elastic_cloud_user) {
                $builder->setBasicAuthentication(
                    $this->settings->elastic_cloud_user,
                    $this->settings->elastic_cloud_password);
            }
        }

        if ($this->settings->elastic_retries) {
            $builder->setRetries($this->settings->elastic_retries);
        }

        if ($this->settings->elastic_connection_pool_class) {
            $builder->setConnectionPool(
                $this->settings->elastic_connection_pool_class);
        }

        if ($this->settings->elastic_connection_selector_class) {
            $builder->setSelector(
                $this->settings->elastic_connection_selector_class);
        }

        if ($this->settings->log_elastic_queries) {
            $builder->setLogger($this->logs->elastic);
        }

        return $builder->build();
    }

    /** @noinspection PhpUnused */
    protected function get_settings(): Settings {
        global $osm_app; /* @var App $osm_app */

        return $osm_app->settings;
    }

    /** @noinspection PhpUnused */
    protected function get_prefix(): ?string {
        $result = (string)$this->settings->elastic_prefix;

        return $result ? $result : null;
    }

    protected function get_logs(): Logs {
        global $osm_app; /* @var App $osm_app */

        return $osm_app->logs;
    }

    public function offsetGet($offset): Index {
        return Index::new([
            'parent' => $this,
            'name' => $offset,
        ]);
    }
}