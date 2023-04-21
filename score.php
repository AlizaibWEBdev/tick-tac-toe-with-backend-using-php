<?php
include "./db.php";

session_start();

if (isset($_SESSION['login']) && $_SESSION['login']==true) {
    $name = $_SESSION["name"];
    if ($_SERVER["REQUEST_METHOD"]=="GET") {
       $query = "SELECT * FROM rank WHERE name='$name'";
       $result = mysqli_query($conn,$query);
       $arr = mysqli_fetch_assoc($result);
       echo$arr['score'];
       }
       if ($_SERVER["REQUEST_METHOD"]=="POST") {
        $old_score = $_POST['score'];
        $old_score = intval($old_score);
        $newScore = $old_score+1;
        $query = "
        
        UPDATE rank
        SET score = '$newScore'
        WHERE name = '$name';
        
        ";

        mysqli_query($conn,$query);
       }
}
