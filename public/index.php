<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Uygulamanın bakım modunda olup olmadığını kontrol et...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Composer otomatik yükleyicisini kaydet...
require __DIR__.'/../vendor/autoload.php';

// Laravel'i başlat ve isteği işle...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
