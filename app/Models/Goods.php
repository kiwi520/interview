<?php

namespace App\Models;

use App\Es\GoodsIndexConfigurator;
use Illuminate\Database\Eloquent\Model;
use ScoutElastic\Searchable;

class Goods extends Model
{
    use Searchable;

    protected $table='goods';
    public $timestamps = true;

    //使用es配置
    protected $indexConfigurator = GoodsIndexConfigurator::class;

    protected $mapping = [
        'properties' => [
            'title' => [
                'type' => 'text',
            ],
            'content' => [
                'type' => 'text',
            ],
        ]
    ];

    public function toSearchableArray()
    {
        return [
            'title'=> $this->title,
            'content' => strip_tags($this->content),
        ];
    }
}
