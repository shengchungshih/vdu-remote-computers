<?php

return [
    'luadm' => [
        'driver'         => 'oracle',
        'tns'            => env('LUADM_TNS', ''),
        'host'           => env('LUADM_HOST', ''),
        'port'           => env('LUADM_PORT', '1521'),
        'database'       => env('LUADM_DATABASE', ''),
        'username'       => env('LUADM_USERNAME', ''),
        'password'       => env('LUADM_PASSWORD', ''),
        'prefix'         => env('LUADM_PREFIX', ''),
        'prefix_schema'  => env('LUADM_SCHEMA_PREFIX', ''),
        'charset'        => env('ORACLE_CHARSET', 'AL32UTF8'),
        'server_version' => env('ORACLE_SERVER_VERSION', '12c'),
    ],

    'rdpis' => [
        'driver'         => 'oracle',
        'tns'            => env('RDPIS_TNS', ''),
        'host'           => env('RDPIS_HOST', ''),
        'port'           => env('RDPIS_PORT', '1521'),
        'database'       => env('RDPIS_DATABASE', ''),
        'username'       => env('RDPIS_USERNAME', ''),
        'password'       => env('RDPIS_PASSWORD', ''),
        'prefix'         => env('RDPIS_PREFIX', ''),
        'prefix_schema'  => env('RDPIS_SCHEMA_PREFIX', ''),
        'charset'        => env('ORACLE_CHARSET', 'AL32UTF8'),
        'server_version' => env('ORACLE_SERVER_VERSION', '12c'),
    ],
];
