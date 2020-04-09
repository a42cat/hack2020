<?

namespace Hack2020\Api;

/**
 * Class Controller
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
     * Controller constructor.
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