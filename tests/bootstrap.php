<?php

declare(strict_types=1);

require dirname(__DIR__).'/vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;

if (class_exists(Dotenv::class)) {
    $dotenv = new Dotenv();

    $dotenv->bootEnv(dirname(__DIR__).'/.env');
}