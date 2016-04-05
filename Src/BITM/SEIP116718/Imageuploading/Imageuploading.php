<?php

namespace App\BITM\SEIP116718\Imageuploading;

use PDO;

error_reporting(E_ALL ^ E_DEPRECATED);

class Imageuploading {

    public $id = '';
    public $title = '';
    public $user_name = '';
    public $image_name = '';
    public $conn = '';
    public $dbuser = 'root';
    public $pw = '';

    public function __construct() {
        try {
            $this->conn = new PDO('mysql:host=localhost;dbname=atomicproject', $this->dbuser, $this->pw);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            echo "Successfully connected";
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    public function prepare($data = '') {
//       echo "<pre>";
//       print_r($data);
//       echo "</pre>";
//       die();
        if (array_key_exists('name', $data) && !empty($data['name'])) {
            $this->user_name = $data['name'];
        }
        if (array_key_exists('image', $data) && !empty($data['image'])) {
            $this->image_name = $data['image'];
        }
        if (array_key_exists('id', $data) && !empty($data['id'])) {
            $this->id = $data['id'];
        }
        return $this;
    }

    public function store() {
        try {
            $stmt = "INSERT INTO `profilepic` (`user_name`, `image`) VALUES (:p, :i)";
            $q = $this->conn->prepare($stmt);
            $q->execute(array(
                ':p' => $this->user_name,
                ':i' => $this->image_name,
            ));

            if ($q) {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['Message'] = 'Successfully added';
                header('location:create.php');
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function index() {
        $mydata = array();
        $stmt = "SELECT * FROM `profilepic` ";
        $q = $this->conn->query($stmt) or die('Unable to query');
        while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
            $mydata[] = $row;
        }
        return $mydata;
        header('location:index.php');
    }

    public function show($id = '') {
        $this->id = $id;
        $stmt = "SELECT * FROM `profilepic` WHERE id=" . $this->id;
        //$query = "SELECT * FROM `profilepic` WHERE id=" . $this->id;
        $q = $this->conn->query($stmt) or die('unable to query');
        $row = $q->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    public function update() {
        session_start();
        if (isset($this->image_name) && !empty($this->image_name)) {
            $stmt = "UPDATE `profilepic` SET `user_name` = :i , `image` = :p WHERE `profilepic`.`id` =:id";

            $q = $this->conn->prepare($stmt);
        }

        $q->execute(array(
            ':i' => $this->user_name,
            ':id' => $this->id,
            ':p' => $this->image_name,
        ));
        $_SESSION['Message'] = "<h2>" . "Data Successfully Updated" . "</h2>";
    }

    public function delete($id = '') {
        session_start();
        $this->id = $id;
        $query = "DELETE FROM `atomicproject18`.`mobiles` WHERE `mobiles`.`id` =" . $this->id;
        $result = mysql_query($query);
//         echo $result;
        header('location:index.php');
        $_SESSION['Message'] = "<h1>" . "Deleted Successfully" . "</h1>";
    }

    public function trash() {
        session_start();
        $query = "UPDATE `atomicproject18`.`mobiles` SET `deleted_at` ='" . date('Y-m-d') . "' WHERE `mobiles`.`id` =" . $this->id;
        mysql_query($query);
        $_SESSION['Message'] = "<h1>" . "Deleted Successfully" . "</h1>";
        header('location:index.php');
    }

    public function trashted() {
        $mydata = array();
        $query = "SELECT * FROM `mobiles` WHERE deleted_at IS NOT NULL";
        $result = mysql_query($query);
//        $row = mysql_fetch_assoc($result);
//        return $row;
        while ($row = mysql_fetch_assoc($result)) {
            $mydata[] = $row;
        }
        return $mydata;
        header('location:index.php');
    }

}
