<a href="create.php">Create</a> |
<a href="index.php">See All Data</a>
<?php
error_reporting(E_ALL ^ E_DEPRECATED);
include_once"../../../../vendor/autoload.php";

use App\BITM\SEIP50\Mobile\Mobile;
use App\BITM\SEIP50\Utility\Utility;

session_start();
if (isset($_SESSION['Message'])) {
    echo $_SESSION['Message'];
    unset($_SESSION['Message']);
}

$Mobiles = new Mobile();

$AllMobiles = $Mobiles->trashted();

$dbg = new Utility();
//$dbg->debug($AllMobiles);
?>
<table border="1">
    <tr>
        <th>
            SL
        </th>
        <th>
            Title
        </th>
        <th>Action</th>
    </tr>
    <?php
    if (isset($AllMobiles) && !empty($AllMobiles)) {
        $serial = 0;
        foreach ($AllMobiles as $OneMobile) {
            $serial++
            ?>
            <tr>
                <td><?php echo $serial ?></td>
                <td><?php echo $OneMobile['title'] ?></td>                 
                <td>
                    <a href="show.php?id=<?php echo $OneMobile['id'] ?>">Show Deails</a>  |
                    <a href="edit.php?id=<?php echo $OneMobile['id'] ?>">Edit</a>  |
                    <a href="delete.php?id=<?php echo $OneMobile['id'] ?>">Delete Permanently</a> 


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
