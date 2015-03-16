<?php defined('SYSPATH') or die('No direct script access.');

return [
    'default' => [
        'type'       => 'MySQLi',
        'connection' => [
            /**
             * The following options are available for MySQLi:
             *
             * string   hostname     server hostname, or socket
             * string   database     database name
             * string   username     database username
             * string   password     database password
             * boolean  persistent   use persistent connections?
             * array    ssl          ssl parameters as "key => value" pairs.
             *                       Available keys: client_key_path, client_cert_path, ca_cert_path, ca_dir_path, cipher
             * array    variables    system variables as "key => value" pairs
             *
             * Ports and sockets may be appended to the hostname.
             */
            'hostname'   => 'localhost',
            'database'   => 'kohana',
            'username'   => FALSE,
            'password'   => FALSE,
            'persistent' => FALSE,
            'ssl'        => NULL,
        ],
        'table_prefix' => '',
        'charset'      => 'utf8',
        'caching'      => FALSE,
    ],
];
