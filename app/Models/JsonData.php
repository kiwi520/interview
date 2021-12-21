<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class JsonData extends Model
{
    protected $table = 'json_data';


    public function batchInsert($data, $count)
    {
        $sql = 'insert into json_data (string, string_json) values  ';

        $valus = [];
        for ($i = 0; $i < $count; $i++) {
//            $sql .= '(?,JSON_ARRAY(?)),';
            $sql .= '(?,?),';
//            array_push($valus,"'".$data[$i]."'","'".$data[$i][1]."'");
//            $dd = strtr($data[$i],['^^'=>'\',\'']);
            $vv = "[" . strtr(strtr($data[$i], ['^^' => '","']), ['^' => '"']) . "]";
//            var_dump($vv);
            array_push($valus, "'" . $data[$i] . "'", $vv);
        }
        $sql = rtrim($sql, ',');

        DB::insert($sql, $valus);

    }

    public function exportJson()
    {
        $limit = 5000;
        $offset = 0;
        $flag = true;

        while ($flag){
            $data = DB::table('json_data')->select('string','string_json')->offset($offset)->limit($limit)->get();
            if ($data->isEmpty()){
                $flag =false;
            }else{
                $offset+= $limit;
                yield $data;
            }

        }

    }
}
