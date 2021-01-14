<?php

declare(strict_types=1);

namespace App\Sheets\Traits;

use App\Sheets\Sheets\Sheets;
use Osm\Core\App;

trait PropertiesTrait
{
    /** @noinspection PhpUnused */
    public function App_Base_Hints_AppHint__app_sheets(App $app): Sheets {
        return $app->cache->remember("app_sheets", function($data) {
            return Sheets::new($data);
        });
    }
}