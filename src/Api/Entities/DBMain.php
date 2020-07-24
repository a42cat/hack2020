<?php

namespace Hack2020\Api\Entities;

use Hack2020\Api\Core\DB;

/**
 * Class DBMain
 * @package Hack2020\Api\Entities
 */
abstract class DBMain
{

    const TABLE_PREFIX = 'fls_games_';

    public $sql;

    public $table_name;

    /**
     * @var array|string[][]
     */
    public $structure = [];

    /**
     * DBMain constructor.
     */
    public function __construct()
    {
        $this->structure = [
            'id' => [
                'TYPE' => 'int(11)',
                'NOT_NULL' => 'true',
                'PRIMARY_KEY' => 'true'
            ]
        ];
    }

    public function DoInstall() {

        $primary_key = '';
        $rows = [];

        $this->sql = "CREATE TABLE IF NOT EXISTS `" . $this->table_name . "` \r\n";

        foreach ($this->structure as $key => $value) {
            $row = "$key ".$value['TYPE']. " ";
            $row .= $value['NOT_NULL'] ? "NOT NULL " : "NULL ";
            if ($value['AUTO_INCREMENT']) $row .= "AUTO_INCREMENT ";
            if ($value['DEFAULT']) $row .= "DEFAULT ".$value['DEFAULT']." ";
            if ($value['PRIMARY_KEY']) $primary_key = $key;
            $rows[] = $row;
        }

        $rows[] = "PRIMARY KEY ($primary_key)";

        var_dump($rows);

        $this->sql = $this->sql . "(" . implode(",\r\n", $rows) . ");";
        var_dump($this->sql);
    }
}