<?php
error_reporting(E_ALL ^ E_DEPRECATED);
include_once"../../../../vendor/autoload.php";

use App\BITM\SEIP116718\Imageuploading\Imageuploading;

$google = new Imageuploading();

if (isset($_FILES['image'])) {
    $errors = array();
    $image_name = time() . $_FILES['image']['name'];
    $image_type = $_FILES['image']['type'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $test = explode('.', $image_name);
    $file_extension = strtolower(end($test));

    $format = array('jpeg', 'jpg', 'png');


    if (in_array($file_extension, $format) === false) {
        $errors[] = 'Wrong Format';
    }
    if (empty($errors)==true) {
        move_uploaded_file($image_tmp_name, "../../../../img/".$image_name);
        $_POST['image'] = $image_name;
    }
}
$google->prepare($_POST);
$google->update();
















