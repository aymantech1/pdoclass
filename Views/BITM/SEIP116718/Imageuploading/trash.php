<a href="create.php">Create</a>
<?php
error_reporting(E_ALL ^ E_DEPRECATED);
//include_once"../../../../Src/BITM/SEIP50/Mobile/Mobile.php";
include_once"../../../../vendor/autoload.php";

use App\BITM\SEIP50\Mobile\Mobile;
use App\BITM\SEIP50\Utility\Utility;

$Delete = new Mobile();
$Deleted = $Delete->prepare($_GET);
$Delete->trash();

$dbg = new Utility();

