<?php

namespace App\Models;

use App\Es\GoodsIndexConfigurator;
use Illuminate\Database\Eloquent\Model;
use ScoutElastic\Searchable;

class EsSearch extends Model
{
    use Searchable;
}
