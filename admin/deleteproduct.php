<?php

session_start();

if(!isset($_SESSION["userID"]) || $_SESSION["userID"] <= 0) {
    header("location: ../login.php");
}

$ID = "";

if(!isset($_GET['productID'])){
    echo "<h2 style='color:red; text-align: center'>Geçersiz ürün. 5 saniye içinde anasayfaya yönlendirileceksiniz.</h2>";
    header("Refresh: 5; url: index.php");
}
else {
    $ID = $_GET['productID'];
    $conn = new mysqli("localhost","root","", "finalproject");
    if($conn->connect_error){
        return -2;
    }

    $query = "DELETE FROM `products` WHERE `ID` = '$ID'";
    if ($conn->query($query) === TRUE) {
        header("location: index.php");
    } else {
        echo "<h2 style='color:red; text-align: center'>$conn->error</h2>";
    }
}
