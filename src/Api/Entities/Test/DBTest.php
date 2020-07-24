<?php


namespace Hack2020\Api\Entities\Test;

use Hack2020\Api\DB;
use Hack2020\Api\Entities\DBMain;

class DBTest extends DBMain
{

    /**
     * DBTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->table_name = self::TABLE_PREFIX.'test';
        $this->structure = array_merge($this->structure, [
            'name' => [
                'TYPE' => 'varchar(50)',
            ]
        ]);
    }
}