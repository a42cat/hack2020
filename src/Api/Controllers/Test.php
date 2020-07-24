<?php

namespace Hack2020\Api\Controllers;

use Hack2020\Api\Core\Controller;
use Hack2020\Api\Core\Response;
use Hack2020\Api\Core\DB;

class Test extends Controller
{

    /**
     * Test constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function TestInstall() {
        $connect = DB::getPdoConnect();
        //$result = $connect->query("SHOW DATABASES;",\PDO::FETCH_ASSOC);
        var_dump($connect);
        /*$test = new DBTest();
        $test->DoInstall();*/
    }
}