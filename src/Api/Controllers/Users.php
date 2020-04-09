<?

namespace Hack2020\Api\Controllers;

use Hack2020\Api\Controller;
use Hack2020\Api\DB;
use Hack2020\Api\Response;

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

        Response::ShowResult($this->response);

        $pdo = DB::getPdoConnect();
        $sql = 'SELECT * FROM '.self::TABLENAME_USERS;
        $result = $pdo->query($sql, \PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $users[(INT)$row['id']] = $row;
        }
        Response::ShowResult($users);
    }
}