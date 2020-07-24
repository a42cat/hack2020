<?

namespace Hack2020\Api\Core;

use Hack2020\Api\Router;

/**
 * Class Controllers
 * @package Api
 */
Abstract Class Controller
{

    /**
     * @var array
     */

    protected $request;
    /**
     * @var array
     */
    protected $response;

    /**
     * Controllers constructor.
     */
    public function __construct()
    {

        $this->request = Request::Instance();
        $this->response = [
            'response' => false,
            'result' => [],
            'errors' => []
        ];
    }

    /**
     * @return mixed
     */
    public static function Run()
    {
        $action = Router::getAction();
        $controller = Router::getControllerObject();

        return $controller->$action();
    }

}