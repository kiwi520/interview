<?php

namespace App\Es;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class GoodsIndexConfigurator extends IndexConfigurator
{
    use Migratable;

    /**
     * @var array
     */
    protected $settings = [
        //
    ];


}
