<?php

namespace App\Services;

use PDO;

class TreeService
{
    private static PDO $db;

    public static function setDatabase(PDO $db): void
    {
        self::$db = $db;
    }

    public function getTree(): array
    {
        $lang = $_GET['lang'];
        $stmt = self::$db->prepare("
            SELECT
                `glob_region`.`gr_name_{$lang}` as 'title',
                `country`.`id` as 'country_id',
                `country`.`c_name_{$lang}` as 'country_name',
                `country`.`c_descr_{$lang}` as 'country_descr',
                `region`.`id` as 'region_id',
                `region`.`r_country_id` as 'region_country_id',
                `region`.`r_name_{$lang}` as 'region_name',
                `region`.`r_descr_{$lang}` as 'region_descr',
                `city`.`id` as 'city_id',
                `city`.`c_country_id` as 'city_country_id',
                `city`.`c_region_id` as 'city_region_id',
                `city`.`c_name_{$lang}` as 'city_name',
                `city`.`c_descr_{$lang}` as 'city_descr'
            FROM
                `glob_region`
                LEFT JOIN
                    `country`
                ON
                    `country`.`glob_region_id` = `glob_region`.`id`
                LEFT JOIN
                    `region`
                ON
                    `region`.`r_country_id` = `country`.`id`
                LEFT JOIN
                    `city`
                ON
                    `city`.`c_country_id` = `country`.`id`
                    OR `city`.`c_region_id` = `region`.`id`
            WHERE
                `glob_region`.`id` = 1
            ORDER BY
                `country_id`, `region_id`, `city_id`
        ");
        $stmt->execute();
        $result = $stmt->fetchAll();

        $tree = [];
        $title = "";
        foreach ($result as $item) {
            $title = $item['title'];
            if (!isset($tree[$item['country_id']])) {
                $tree[$item['country_id']] = [
                    'id' => $item['country_id'],
                    'name' => $item['country_name'],
                    'description' => $item['region_descr'],
                    'regions' => [],
                    'cities' => [],
                ];
            }

            if ($item['city_region_id'] > 0) {
                if(!isset($tree[$item['country_id']]['regions'][$item['region_id']])) {
                    $tree[$item['country_id']]['regions'][$item['region_id']] = [
                        'id' => $item['region_id'],
                        'name' => $item['region_name'],
                        'description' => $item['country_descr'],
                        'cities' => [],
                    ];
                }

                if(!isset($tree[$item['country_id']]['regions'][$item['region_id']]['cities'][$item['city_id']])) {
                    $tree[$item['country_id']]['regions'][$item['region_id']]['cities'][$item['city_id']] = [
                        'id' => $item['city_id'],
                        'name' => $item['city_name'],
                        'description' => $item['city_descr'],
                    ];
                }
            } else {
                if(!isset($tree[$item['country_id']]['cities'][$item['city_id']])) {
                    $tree[$item['country_id']]['cities'][$item['city_id']] = [
                        'id' => $item['city_id'],
                        'name' => $item['city_name'],
                        'description' => $item['city_descr'],
                    ];
                }
            }

        }


        return [
            'items' => $tree,
            'title' => $title,
        ];
    }
}
