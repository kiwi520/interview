<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Article extends Model
{
    use Searchable;

    const SEARCHABLE_FIELDS= ['id','title','author','content'];

    public function store()
    {
        $model_article = new Article();
        $model_article->title = '不败君';
        $model_article->content = 'www.bubaijun.com 不败君使用 ES';
        $model_article->save();
    }

    public function search()
    {
        return Article::search('不败君')->get();
    }

    /**
     * 需要查询的字段
     * @return array
     */
    public function toSearchableArray()
    {
        return $this->only(self::SEARCHABLE_FIELDS);
    }
}
