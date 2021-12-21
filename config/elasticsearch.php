<?php


return [
    'hosts' => [
        env('ELASTICSEARCH_HOST')
    ],
    'log_index' => env('ELASTICSEARCH_INDEX'),
    'log_type' => env('ELASTICSEARCH_TYPE'),
];
