<?php

define("ROOT", dirname(__DIR__));

const CONFIG = ROOT . '/config';
const HELPERS = ROOT . '/helpers';
const APP = ROOT . '/app';
const CORE = ROOT . '/core';
const VIEWS = APP . '/Views';
const LAYOUT = 'default';
const PATH = 'http://localhost:8888';

const DB = array(
    'db_host' => 'localhost',
    'db_user' => 'root',
    'db_password' => 'root',
    'db_db' => 'Lard',
);

const DB_SETTINGS = [
    'driver' => 'mysql',
    'host' => '127.0.0.1',
    'database' => 'Info-Air',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',
    'collation' => 'utf8_general_ci',
    'prefix' => '',
    'port' => 8889,
];
