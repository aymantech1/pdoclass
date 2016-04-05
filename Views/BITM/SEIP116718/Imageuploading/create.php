<?php
session_start();
if (isset($_SESSION['Message'])) {
    echo $_SESSION['Message'];
    unset($_SESSION['Message']);
}
?>

<html>
    <head>
        <title>Create | Image</title>
    </head>
    <body>
        <fieldset>
            <legend>
                Image Uploading
            </legend> 
            <form action="store.php" method="post" enctype="multipart/form-data">
                <label>Name:</label>
                <input type="text" name="name">
                
                
                <input type="file" name="image">
                <input type="submit" value="Save">
                <!--<input type="submit" value="Save & Enter Again">-->
                <input type="reset" value="Reset">
            </form>
        </fieldset>
    </body>
</html>