<?

namespace Hack2020\Api;

use PDO;
use PDOException;

Abstract Class DB {
    const DB_HOST = '127.0.0.1';

    const DB_LOGIN = 'root';

    const DB_PASSWORD = '123';

    const DB_NAME = 'hack';

    public static function getPdoConnect() {
        $dsn = 'mysql:dbname='.self::DB_NAME.';host='.self::DB_HOST;
        $user = self::DB_LOGIN;
        $password = self::DB_PASSWORD;

        try {
            $pdo = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            Response::ServerError($e->getMessage(), 500);
        }

        return new PDO($dsn, $user, $password);
    }
}