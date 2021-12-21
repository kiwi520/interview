<?php

namespace App\Http\Controllers;

use App\Models\JsonData;
use Illuminate\Http\Request;

class JsonDataController extends Controller
{
    public function batchImport()
    {
        ini_set('memory_limit', '500M');
        set_time_limit(0);
        $t1 = microtime(true);
        print_r("开始");
        $file = json_decode(file_get_contents(storage_path('app/sample.json'), true));

        $arr = [];
        $num = 0;

        foreach ($file as $item) {
            $num++;
            array_push($arr, $item->string);

            $count = 5000;
            if (is_int($num / $count)) {
                $model = new  JsonData();
                $model->batchInsert($arr,$count);
                unset($arr);
                $arr = [];
                //刷新缓冲区
                ob_flush();
                flush();
            }
        }

        $t2 = microtime(true);
        print_r("结束");
        echo '耗时: ' . round($t2 - $t1, 3) . '秒<br>';

        echo '消耗内存: ' . $this->memory_usage() . '<br />';

//
    }

    function memory_usage()
    {
        $memory = (!function_exists('memory_get_usage')) ? '0' : round(memory_get_usage() / 1024 / 1024, 2) . 'MB';
        return $memory;
    }

    public function exportJson(){
        ini_set('memory_limit', '1000M');
        set_time_limit(0);
        header('content-type:application/octet-stream;charset=utf-8');
        header('Content-Disposition:attachment;filename*=sample_output.json');

        $model = new JsonData();
        foreach ($model->exportJson() as $value){
            if (!empty($value)){
                echo $value;
            }
        }
        exit;
    }

}
