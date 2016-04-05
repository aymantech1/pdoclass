<a href="create.php">Create</a> | 
<a href="trashted.php">See Deleted Items</a>
<?php
error_reporting(E_ALL ^ E_DEPRECATED);
include_once"../../../../vendor/autoload.php";

use App\BITM\SEIP116718\Imageuploading\Imageuploading;
session_start();
if (isset($_SESSION['Message'])) {
    echo $_SESSION['Message'];
    unset($_SESSION['Message']);
}

$id = $_GET['id'];

$Picture = new Imageuploading();

$one = $Picture->show($id);

echo "<pre>";
print_r($one);
echo "</pre>";
?>
<html>
    <head>
        <title>Update | Mobile Models</title>
    </head>
    <body>
        <fieldset>
            <legend>
                Update Profile Information
            </legend> 
            <form action="update.php" method="post" enctype="multipart/form-data">
                <label>Name:</label>
                <input type="text" name="name" value="<?php echo $one['user_name'] ?>">
                
                
                <input type="file" name="image">
                <img src="<?php echo "../../../../img/".$one['image'] ?>"/>
                <input type="submit" value="Update">
                
                <input type="reset" value="Reset">
                <input type="hidden" value="<?php echo $_GET['id'] ?>" name="id">
            </form>
        </fieldset>
    </body>
</html>