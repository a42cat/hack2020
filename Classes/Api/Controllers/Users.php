<?

namespace Api\Controllers;

use Api\Controller;
use Api\DB;
use Api\Response;

/**
 * Class User
 * @package Api\Controllers
 */
Class Users extends Controller
{

    const TABLENAME_USERS = 'Users';

    public function __construct()
    {
        parent::__construct();
    }

    public function GetUsers()
    {
        $users = [];

        $pdo = DB::getPdoConnect();
        $sql = 'SELECT * FROM '.self::TABLENAME_USERS;
        $result = $pdo->query($sql, \PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $users[(INT)$row['id']] = $row;
        }
        Response::ShowResult($users);
    }
}