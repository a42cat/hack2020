<?php


namespace Hack2020\Api\Controllers;


use Hack2020\Api\Controller;
use Hack2020\Api\Response;

class Test extends Controller
{
    public function GetTest() {
        Response::ShowResult(['test' => 'success']);
    }
}