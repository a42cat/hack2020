<?php


namespace Hack2020\Api\Controllers;


use Hack2020\Api\Response;

class Test
{
    public function GetTest() {
        Response::ShowResult(['test' => 'success']);
    }
}