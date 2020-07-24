<?

namespace Hack2020\Api\Core;

use PDO;
use PDOException;

Abstract Class DB {

    public static  function GetHost() {
        $host = Config::DB_HOST;
        if ($_SERVER['HTTP_HOST'] !== 'hometechcat.ru') {
            $host .= ';port=3336;';
        }
        return $host;
    }

    public static function getPdoConnect() {
        $dsn = 'mysql:dbname='.Config::DB_NAME.';host='.self::GetHost();
        //var_dump($dsn);
        $user = Config::DB_USER;
        $password = Config::DB_PASS;

        try {
            $pdo = new PDO($dsn, $user, $password);
            return $pdo;
        } catch (PDOException $e) {
            Response::ServerError($e->getMessage(), 500);
        }
    }
}