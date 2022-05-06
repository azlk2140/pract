<?php
namespace Azlk;
use mysqli;

class DB {
    static $host = "localhost";
    static $user = "root";
    static $password = "";
    static $database = "azlk";
    public $link;

    public function __construct() {
        $this->link = new mysqli(DB::$host, DB::$user, DB::$password, DB::$database);
        $this->link->set_charset("utf8");
    }

    public function get_all_photos() {
        $sql_result = $this->link->query("SELECT * FROM `azlk2` ORDER BY `Id` DESC");
        if ($sql_result->num_rows) {
            return $sql_result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }

    public function get_user_photos($uid) {
        $sql_result = $this->link->query("SELECT * FROM `azlk2` WHERE `Uid` = $uid ORDER BY `Id` DESC");
        if ($sql_result->num_rows) {
            return $sql_result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }

    public function check_user($login, $password) {
        $sql_result = $this->link->query("SELECT * FROM `azlk1` WHERE `Email`='$login' AND `Password` = '$password'");
        if ($sql_result->num_rows) {
            $user = $sql_result->fetch_assoc();
            return $user["Id"];
        }
        return false;
    }

    public function check_login($login) {
        $sql_result = $this->link->query("SELECT * FROM `azlk1` WHERE `Email`='$login'");
        if ($sql_result->num_rows) {
            return true;
        }
        return false;
    }

    public function new_user($login, $password) {
        $this->link->query("INSERT INTO `azlk1` (Name, Password, Email) VALUES ('', '$password', '$login')");
    }

    public function new_photo($uid, $image, $text) {
        $this->link->query("INSERT INTO `azlk2` (Uid, Image, Text, Tags) VALUES ($uid, '$image', '$text', '')");
    }

    public function get_photo_by_id($photo_id) {
        $sql_result = $this->link->query("SELECT `p`.*, `u`.`Name` FROM `azlk2` `p` LEFT JOIN `azlk1` `u` on `u`.`Id` = `p`.`Uid` WHERE `p`.`Id` = '$photo_id'");
        if ($sql_result->num_rows) {
            return $sql_result->fetch_assoc();
        }
        return false;
    }

    public function get_photo_comments($photo_id) {
        $sql_result = $this->link->query(
            "SELECT `c`.*, `u`.`Name` FROM `azlk3` `c` LEFT JOIN `azlk1` `u` on `u`.`Id` = `c`.`Uid` 
            WHERE `c`.`Pid` = '$photo_id' ORDER BY `Id` DESC");

      if ($sql_result->num_rows) {
            return $sql_result->fetch_all(MYSQLI_ASSOC);
        }
        return[];
    }

    public function add_comment($pid, $uid, $text) {
        $date = date("Y-m-d");
        $this->link->query("INSERT INTO `azlk3` (Pid, Uid, Text, Post_date) VALUES ($pid, $uid, '$text', '$date')");
        $last_id = $this->link->insert_id;
        $inserted_comment = $this->link->query(
            "SELECT `c`.*, `u`.`Name` FROM `azlk3` `c` LEFT JOIN `azlk1` `u` on `u`.`Id` = `c`.`Uid` WHERE `c`.`Id` = '$last_id'");
        return $inserted_comment->fetch_assoc();
    }
}