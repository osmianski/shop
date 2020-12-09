<?php

namespace App\Products\Traits;

use App\Products\Products;

trait PropertiesTrait
{
    public function App_Base_Hints_AppHint__products() {
        return Products::new();
    }

}