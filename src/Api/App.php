<?

namespace Hack2020\Api;

/**
 * Class App
 * @package Api
 */
Class App
{
    /**
     * @var Request
     */
    protected $request;
    /**
     * @var array
     */
    protected $response;

    /**
     * App constructor.
     */
    public function __construct()
    {
        $this->request = Request::Instance();
        $this->response = [];
    }

    /**
     * App start function
     */
    public function Run()
    {
        $this->setHeaders();

        $router = new Router();
        $router->Run();
        $controller = $router->getControllerObject();

        $this->response = $controller::run();

        //Response::ShowResult($this->response);
    }

    /**
     * Set headers for app
     */
    private function setHeaders()
    {
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization-Token');
        header('Access-Control-Allow-Origin: ' . $_SERVER['SERVER_NAME']);
    }
}