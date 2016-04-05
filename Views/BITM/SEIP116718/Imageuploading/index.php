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


$Picture = new Imageuploading();

$AllPicture = $Picture->index();


?>
<table border="1">
    <tr>
        <th>
            SL
        </th>
        <th>
           User Name
        </th>
        <th>
           Profile Pic
        </th>
        <th>Action</th>
    </tr>
    <?php
    if (isset($AllPicture) && !empty($AllPicture)) {
        $serial = 0;
        foreach ($AllPicture as $OnePicture) {
            $serial++
            ?>
            <tr>
                <td><?php echo $serial ?></td>
                <td><?php echo $OnePicture['user_name'] ?></td>                 
                <td><img src="<?php echo "../../../../img/".$OnePicture['image'] ?>" width="200" height="140"></td>                 
                <td>
                    <a href="show.php?id=<?php echo $OnePicture['id'] ?>">Show Deails</a>  |
                    <a href="edit.php?id=<?php echo $OnePicture['id'] ?>">Edit</a>  |
                    <a href="trash.php?id=<?php echo $OnePicture['id'] ?>">Delete</a> 
                </td>
            </tr>
            <?php
        }
    } else {
        ?>
        <tr>
            <td colspan="3">
                <?php echo "No avilable Data"; ?>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
<?php
//$dbg->debug($data);
?>