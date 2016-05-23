<?php

session_start();

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
            <?php
            if(isset($_SESSION["userID"]) && $_SESSION["userID"] > 0){
                echo "<div class='right'>". $_SESSION["username"] ." | <a href=\"logout.php\">Çıkış</a></div>";
            } else {
                echo "<div class='right'><a href=\"login.php\">Oturum Aç</a> | <a href=\"register.php\">Kaydol</a></div>";
            }
            ?>
        </div>
        <div class="full-width">
            <div id="logo"><img src="content/img/logo.gif" width="272" height="53" alt="Programlama Dilleri" /></div>
            <div id="menu">
                <ul>
                    <li><a href="index.php">ANASAYFA</a></li>
                    <li><a href="about.php">HAKKINDA</a></li>
                    <li><a href="products.php">URUNLER</a></li>
                    <li><a href="references.php">REFERANSLAR</a></li>
                    <li><a href="contact.php">İLETİŞİM</a></li>
                    <?php
                    if(isset($_SESSION["userID"]) && $_SESSION["userID"] > 0) {
                        echo "<li><a href=\"admin\index.php\">YÖNETİM</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <div id="gorsel"><img src="content/img/gorsel.png" width="960" height="254" alt="Programlama Dilleri" /></div>
    <div id="icerik">
        <h1>Urunler</h1>
        <ul class="products">
            <?php
            $conn = new mysqli("localhost","root","", "finalproject");

            $productQuery = "SELECT ID, Name, ImageName FROM `products`";
            $productResult = $conn->query($productQuery);
            if($productResult && $productResult->num_rows > 0){
                while($row = $productResult->fetch_assoc()) {
                    echo "<li><a href='product.php?productID=". $row["ID"] ."'><img src='content/products/". $row["ImageName"] ."' width='220' height='147' alt='". $row["Name"] ."' /></a></li>";
                }
            } else {
                echo "Hiç ürün yok.";
            }
            ?>
        </ul>
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