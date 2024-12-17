<?php
/** @var Core\Application $app */

use App\Controllers\TreeController;

$app->router->get('/', [TreeController::class, 'index']);

