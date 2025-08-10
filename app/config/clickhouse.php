<?php

return [
    'host'     => env('CLICKHOUSE_HOST', 'clickhouse'),
    'port'     => env('CLICKHOUSE_PORT', '8123'),
    'username' => env('CLICKHOUSE_USERNAME', ''),
    'password' => env('CLICKHOUSE_PASSWORD', ''),

    'options' => [
        'timeout'  => 10,
        'connect_timeout' => 5
    ]
];
