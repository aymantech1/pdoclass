<a href="create.php">Create</a>
<?php
error_reporting(E_ALL ^ E_DEPRECATED);
//include_once"../../../../Src/BITM/SEIP50/Mobile/Mobile.php";
include_once"../../../../vendor/autoload.php";

use App\BITM\SEIP50\Mobile\Mobile;
use App\BITM\SEIP50\Utility\Utility;
$id = $_GET['id'];
//echo $id;


$Mobile = new Mobile();

$OneMoile = $Mobile->show($id);



$dbg = new Utility();

//$dbg->debug($OneMoile);
?>
<table border="1">
    <tr>
        <th>ID</th>
        
        <th>Title</th>
        <th>Created</th>
        <th>Modified</th>
        <th>Action</th>
    </tr>
    <tr>
        <td><?php echo $OneMoile['id']?></td>
        <td><?php 
        if(isset($OneMoile['title']) && !empty($OneMoile['title'])){
        echo $OneMoile['title'];
        
        }else{
            echo "No title avilable for this model";
        }
        
        
        ?>
        
        </td>
        <td><?php echo $OneMoile['created']?></td>
        <td><?php echo $OneMoile['updated']?></td>
        <td>
            <a href="edit.php?id=<?php echo $id; ?>">Edit</a> |
            <a href="delete.php?id=<?php echo $id; ?>">Delete</a> 
            
        </td>
    </tr>
</table>





