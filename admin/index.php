<?php

session_start();

if(!isset($_SESSION["userID"]) || $_SESSION["userID"] <= 0) {
    header("location: ../login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CanBurakOzsoy</title>

    <link type="text/css" rel="stylesheet" href="content/css/style.css"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <script type="text/javascript" src="content/js/app.js"></script>
</head>

<body>

<div id="sayfaUst">
    <div id="ust">
        <div class="full-width">
            <div class='right'><?= $_SESSION["username"] ?> | <a href="../logout.php">Çıkış</a></div>
        </div>
        <div class="full-width">
            <div id="logo"><img src="content/img/logo.gif" width="272" height="53" alt="Programlama Dilleri" /></div>
            <div id="menu">
                <ul>
                    <li><a href="../index.php">ANASAYFA</a></li>
                    <li><a href="../about.php">HAKKINDA</a></li>
                    <li><a href="../products.php">URUNLER</a></li>
                    <li><a href="../references.php">REFERANSLAR</a></li>
                    <li><a href="../contact.php">İLETİŞİM</a></li>
                    <li><a href="index.php">YÖNETİM</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div id="gorsel"></div>
    <div id="icerik">
        <?php
        $conn = new mysqli("localhost","root","", "finalproject");

        echo "<h2>Kullanıcılar</h2>";
        echo "<table class='data-table'><tr><th>Kullanıcı Adı</th><th>E-Posta</th><th>İşlem</th></tr>";

        $userQuery = "SELECT ID, Username, Email FROM `users`";
        $userResult = $conn->query($userQuery);
        if($userResult && $userResult->num_rows > 0){
            while($row = $userResult->fetch_assoc()) {
                echo "<tr><td>". $row["Username"] ."</td><td>". $row["Email"] ."</td><td><a href='deleteuser.php?userID=" . $row["ID"] . "'>Sil</a></td></tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Hiç kullanıcı yok</td></tr>";
        }
        echo "</table>";



        echo "<h2>Ürünler</h2>";
        echo "<table class='data-table'><tr><th>Adı</th><th>Resim Adı</th><th>Kısa Açıklama</th><th>İşlem</th></tr>";

        $productQuery = "SELECT ID, Name, ImageName, Description FROM `products`";
        $productResult = $conn->query($productQuery);
        if($productResult && $productResult->num_rows > 0){
            while($row = $productResult->fetch_assoc()) {
                $desc = $row["Description"];
                if(strlen($desc) > 80){
                    $desc = substr($desc, 0, 80);
                }

                echo "<tr><td>". $row["Name"] ."</td><td>". $row["ImageName"] ."</td><td>". $desc ."</td><td><a href='updateproduct.php?productID=" . $row["ID"] . "'>Güncelle</a> | <a href='deleteproduct.php?productID=" . $row["ID"] . "'>Sil</a></td></tr>";
            }
            echo "<tr><td colspan='4'><a href='newproduct.php'>Ekle</a></td></tr>";
        } else {
            echo "<tr><td colspan='4'>Hiç ürün yok | <a href='newproduct.php'>Ekle</a></td></tr>";
        }
        echo "</table>";




        echo "<h2>Referanslar</h2>";
        echo "<table class='data-table'><tr><th>Adı</th><th>Resim Adı<th>İşlem</th></tr>";

        $referenceQuery = "SELECT ID, Name, ImageName FROM `reference`";
        $referenceResult = $conn->query($referenceQuery);
        if($referenceResult && $referenceResult->num_rows > 0){
            while($row = $referenceResult->fetch_assoc()) {

                echo "<tr><td>". $row["Name"] ."</td><td>". $row["ImageName"] ."</td><td><a href='updatereference.php?referenceID=" . $row["ID"] . "'>Güncelle</a> | <a href='deletereference.php?referenceID=" . $row["ID"] . "'>Sil</a></td></tr>";
            }
            echo "<tr><td colspan='4'><a href='newreference.php'>Ekle</a></td></tr>";
        } else {
            echo "<tr><td colspan='4'>Hiç referans yok | <a href='newreference.php'>Ekle</a></td></tr>";
        }
        echo "</table>";
        ?>
    </div>
</div>
<div id="sayfaAlt">
    <div id="footer">
        <div id="footer_sol">
            <p><a href="index.php">Anasayfa</a> | <a href="about.php">Hakkında</a> | <a href="products.php">Urunler</a> | <a href="references.php">Referanslar</a> | <a href="contact.php">İletişim</a></p>
            <p>Copyright 2016 Programlama Dilleri<br />
            </p>
        </div>
    </div>
</div>
</body>

</html>