<?

namespace Hack2020\Api;

use Hack2020\Api\Core\Response;

/**
 * Class Router
 * @package Api
 */
Class Router
{

    /**
     * controllers directories
     */
    const ROOT_DIR_CONTROLLERS = 'Controllers';
    /**
     * @var String
     */
    private static $controllerPath;
    /**
     * @var String
     */
    private static $apiPath;
    /**
     * @var String
     */
    private static $controller;
    /**
     * @var String
     */
    private static $controllerClass;
    /**
     * @var String
     */
    private static $action;
    /**
     * @var String
     */
    private static $pathParts;

    /**
     * @return mixed
     */
    public static function getController()
    {
        return self::$controller;
    }

    /**
     * @return mixed
     */
    public static function getControllerObject()
    {

        self::$controllerClass = false;
        self::$controllerPath = __DIR__ . DIRECTORY_SEPARATOR . self::ROOT_DIR_CONTROLLERS . DIRECTORY_SEPARATOR . self::$controller . '.php';

        if (!file_exists(self::$controllerPath)) {
            //Response::BadRequest(Loc::getMessage('CLASS_NOT_FOUND', ['#OBJECT#' => ucfirst(parent::getController())]));
            Response::BadRequest('Controllers not found');
        } else {
            self::$controllerClass = __NAMESPACE__ . '\\' . self::ROOT_DIR_CONTROLLERS . '\\' . ucfirst(self::$controller);
        }

        return new self::$controllerClass;
    }

    /**
     * @return mixed
     */
    public static function getAction()
    {
        if (method_exists(self::$controllerClass, self::$action)) {
            return self::$action;
        } else {
            Response::BadRequest('method not found');
        }
    }

    /**
     * Run router
     */
    public function Run()
    {
        self::GetControllerAndMethod();
    }

    /**
     * get controller and method name from URL
     */
    public function GetControllerAndMethod()
    {
        self::$pathParts = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        self::$apiPath = current(self::$pathParts);
        array_shift(self::$pathParts);

        // Get controller
        if (current(self::$pathParts)) {
            self::$controller = current(self::$pathParts);
            array_shift(self::$pathParts);
        }

        // Get action
        if (current(self::$pathParts)) {
            self::$action = current(self::$pathParts);
            array_shift(self::$pathParts);
        }
    }

}