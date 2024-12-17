<?php

require_once __DIR__ . '/../config/config.php';
require_once ROOT . '/vendor/autoload.php';
require_once HELPERS . '/helpers.php';

use Core\Application;
use Core\DataBase;
use App\Services\TreeService;

$app = new Application();
$db = new DataBase();
$pdo = $db->getConnection();
TreeService::setDatabase($pdo);


require_once CONFIG . '/routes.php';

$app->run();


