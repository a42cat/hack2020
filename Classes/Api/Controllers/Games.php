<?
namespace Api\Controllers;

use Api\Controller;
use Api\DB;
use Api\Response;

Class Games extends Controller {

    const TABLE_NAME_GAMES = 'Games';

    const TABLE_NAME_GAMESLOG = 'Games_log';

    public function __construct()
    {
        parent::__construct();
    }

    public function GetGames() {
        $games = [];

        $pdo = DB::getPdoConnect();
        $sql = 'SELECT * FROM '.self::TABLE_NAME_GAMES;
        $result = $pdo->query($sql, \PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $games[(INT)$row['id']] = $row;
        }
        Response::ShowResult($games);
    }

}