<?

namespace Hack2020\Api;

/**
 * Class Request
 * @package Api
 */
Class Request
{
    /**
     * @var Request
     */
    protected static $instance;
    /**
     * @var string
     */
    protected static $realIp;
    /**
     * @var array
     */
    protected $params;

    /**
     * @return Request
     */
    public static function Instance()
    {
        if (!isset(static::$instance)) {
            static::$instance = new static();
            static::$instance->Init();
        }

        if (Router::getController()) {
            self::$instance->params['CONTROLLER'] = Router::getController();
        }

        if (Router::getController()) {
            self::$instance->params['ACTION'] = Router::getAction();
        }

        return static::$instance;
    }

    /**
     * Init instance
     */
    protected function Init()
    {
        $this->get();
    }

    /**
     * @return array
     */
    public function get()
    {
        if (isset($this->params)) {
            return $this->params;
        }

        $this->params = [
            'DATE' => date('Y-m-d H:i:s'),
            'REQUEST_METHOD' => self::getMethod(),
            'IP_ADDRESS' => self::getRealIpAddr(),
            'PARAMETERS' => self::getParameters()
        ];

        if (isset($_SERVER['HTTP_AUTHORIZATION_TOKEN'])) {
            $this->params['AUTHORIZATION_TOKEN'] = $_SERVER['HTTP_AUTHORIZATION_TOKEN'];
        }
        if (isset($_SERVER['HTTP_AUTHORIZATION_LOGIN'])) {
            $this->params['AUTHORIZATION_LOGIN'] = $_SERVER['HTTP_AUTHORIZATION_LOGIN'];
        }
        if (isset($_SERVER['HTTP_AUTHORIZATION_PASSWORD'])) {
            $this->params['AUTHORIZATION_PASSWORD'] = $_SERVER['HTTP_AUTHORIZATION_PASSWORD'];
        }

        return $this->params;
    }

    /**
     * @return mixed
     */
    public static function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @return mixed
     */
    public static function getRealIpAddr()
    {
        if (!self::$realIp) {
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                self::$realIp = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                self::$realIp = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                self::$realIp = $_SERVER['REMOTE_ADDR'];
            }
        }
        return self::$realIp;
    }

    /**
     * @return mixed
     */
    public function getParameters()
    {
        return $_REQUEST;
    }

}