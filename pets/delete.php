<?php
    session_start();

    if((!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) || isset($_SESSION["user"])){
        header("Location: /BE20_CR5_SahraStursa/index.php");
    }
    require_once '../components/db_connect.php';

    if(isset($_GET["id"]) && !empty($_GET["id"])){
        $id = $_GET["id"];
        $sql = "SELECT * FROM `pets` WHERE `pet_id` = $id";
        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);
        if($row["pet_img"] !== "pet.jpg"){
            unlink("../assets/$row[pet_img]");
        }

        $sql = "DELETE FROM `pets` WHERE pet_id=$id";
        mysqli_query($conn, $sql);

        mysqli_close($conn);
        header("Location: ../index.php");
    }
    else{
        mysqli_close($conn);
        header("Location: ../index.php");
    }