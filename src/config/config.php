<?php

use Monolog\Logger;

return [
    'audit' => [
        'minimum_level' => Logger::DEBUG,
        'path' => getcwd() . '/storage/logs/application.log',
        'handler' => \Monolog\Handler\StreamHandler::class
    ]
];