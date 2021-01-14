<?php

namespace App\Samples\Sheets\Migrations\Schema;

use App\Sheets\Sheets\Sheets;
use App\Sheets\Sheets\Table;
use Osm\Core\App;
use Osm\Framework\Migrations\Migration;

/**
 * @property Sheets|Table[] $app_sheets @required
 */
class m01_t_posts extends Migration
{
    /** @noinspection PhpUnused */
    protected function get_app_sheets(): Sheets {
        global $osm_app; /* @var App $osm_app */

        return $osm_app->app_sheets;
    }

    public function up() {
        $this->app_sheets['t_posts']->create();
    }

    public function down() {
        $this->app_sheets['t_posts']->drop();
    }
}
