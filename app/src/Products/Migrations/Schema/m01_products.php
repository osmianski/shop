<?php

namespace App\Products\Migrations\Schema;

use App\Sheets\Sheets\Sheets;
use App\Sheets\Sheets\Table;
use Osm\Core\App;
use Osm\Framework\Migrations\Migration;

/**
 * @property Sheets|Table[] $app_sheets @required
 */
class m01_products extends Migration
{
    /** @noinspection PhpUnused */
    protected function get_app_sheets(): Sheets {
        global $osm_app; /* @var App $osm_app */

        return $osm_app->app_sheets;
    }

    public function up() {
        $this->app_sheets['products']->create();
    }

    public function down() {
        $this->app_sheets['products']->drop();
    }
}
