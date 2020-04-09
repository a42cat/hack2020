<?

if ($_GET['q'] == true) {
    var_dump(123);
}
require_once  '../vendor/autoload.php';

use Hack2020\Api\App;

$api = new App();
$api->Run();