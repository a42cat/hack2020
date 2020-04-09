<?

namespace Hack2020\Api;

Class Response
{
    public static function ShowResult($data, $options = false)
    {
        self::setHeaders();
        header('HTTP/1.1 200');
        $arResponse = array_merge(['status' => 200], $data);
        $result = json_encode($arResponse, $options);

        if ($error = self::ckeckError()) {
            header('HTTP/1.1 500');
            $result = json_encode(['status' => 500, 'result' => $error]);
        }
        echo $result;
        die();
    }

    private static function setHeaders()
    {
        header('Powered: Msa-it 2018-' . date('Y'));
        header('Support: http://msait.info');
        header('Content-Type: application/json; charset=utf-8');
    }

    private static function ckeckError()
    {

        $result = false;

        switch (json_last_error()) {

            case JSON_ERROR_DEPTH:
                $result = 'JSON_ERROR_DEPTH';
                break;
            case JSON_ERROR_STATE_MISMATCH:
                $result = 'JSON_ERROR_STATE_MISMATCH';
                break;
            case JSON_ERROR_CTRL_CHAR:
                $result = 'JSON_ERROR_CTRL_CHAR';
                break;
            case JSON_ERROR_SYNTAX:
                $result = 'JSON_ERROR_SYNTAX';
                break;
            case JSON_ERROR_UTF8:
                $result = 'JSON_ERROR_UTF8';
                break;
        }

        return $result;
    }

    public static function NoResult($message = '')
    {
        self::setHeaders();

        $message = ($message) ? $message : 'No Result';
        header('HTTP/1.1 200');
        echo json_encode(['status' => 200, 'error' => $message]);
        die();
    }

    public static function ServerError($message, $error = 500)
    {
        self::setHeaders();

        $message = ($message) ? $message : 'Server error';
        header('HTTP/1.1 ' . $error);
        echo json_encode(['status' => $error, 'error' => $message]);
        die();
    }

    public static function BadRequest($message = '')
    {
        self::setHeaders();

        $message = ($message) ? $message : 'Bad Request';
        header('HTTP/1.1 400');
        echo json_encode(['status' => 400, 'error' => $message]);
        die();
    }

    public static function NotFound($message = '')
    {
        self::setHeaders();
        $message = ($message) ? $message : 'Not found';
        header('HTTP/1.1 404');
        echo json_encode(['status' => 404, 'error' => $message]);
        die();
    }

    public static function DenyAccess()
    {
        self::setHeaders();
        header('HTTP/1.1 403');
        echo json_encode(['status' => 403, 'error' => 'Forbidden']);
        die();
    }
}