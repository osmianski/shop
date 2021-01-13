<?php

declare(strict_types=1);

namespace App\Base\Hints;

use Osm\Framework\Settings\Settings;

/**
 * @see \App\Elastic\Module:
 * @see https://www.elastic.co/guide/en/elasticsearch/client/php-api/current/configuration.html
 *
 * @property string $elastic_prefix @required @part
 * @property array $elastic_hosts @part
 * @property string $elastic_cloud_id @part
 * @property string $elastic_cloud_user @part
 * @property string $elastic_cloud_password @part @required
 * @property string $elastic_cloud_api_id @part
 * @property string $elastic_cloud_api_key @part @required
 * @property int $elastic_retries @part
 * @property string $elastic_connection_pool_class @part
 * @property string $elastic_connection_selector_class @part
 * @property bool $log_elastic_queries @part
 */
abstract class SettingsHint extends Settings
{

}