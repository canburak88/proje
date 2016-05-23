<?php

session_start();

if(!isset($_SESSION["userID"]) || $_SESSION["userID"] <= 0) {
    header("location: ../login.php");
}

@$ID = "";
@$NAME = "";
@$IMAGENAME = "";
@$DESCRIPTION = "";
@$URL = "";
@$USERID = $_SESSION["userID"];
@$ERROR_MESSAGE = "";

function update($id, $name, $imageName, $description, $url){
    $conn = new mysqli("localhost","root","", "finalproject");
    if($conn->connect_error){
        return -2;
    }

    $query = "UPDATE `products` SET `Name` = '$name', `ImageName` = '$imageName', `Description` = '$description'  , `Url` = '$url' WHERE `ID` = '$id'";
    $cmd = $conn->prepare("UPDATE `products` SET `Name` = ?, `ImageName` = ?, `Description` = ?  , `Url` = ? WHERE `ID` = ?");
    $cmd->bind_param("sssss", $name, $imageName, $description, $url, $id);

    if ($cmd->execute() === TRUE) {
        return 1;
    } else {
        echo $conn->error;
        return -1;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ID = $_REQUEST['productid'];
    $NAME = $_REQUEST['name'];
    $IMAGENAME = $_REQUEST['imagename'];
    $DESCRIPTION = $_REQUEST['description'];
    $URL = $_REQUEST['url'];

    if(empty($ID)){
        $ERROR_MESSAGE = "Geçersiz ürün.";
    }
    else {
        if (empty($NAME) || empty($IMAGENAME) || empty($DESCRIPTION) || empty($URL)) {
            $ERROR_MESSAGE = "Bütün bilgileri eksiksiz girin.";
        } else {
            $result = update($ID, $NAME, $IMAGENAME, $DESCRIPTION, $URL);
            if($result == 1){
                header("location: index.php");
            } else if($result == -2){
                $ERROR_MESSAGE = "Veritabanına bağlanılamadı.";
            } else if ($result == -1){
                $ERROR_MESSAGE = "Güncelleme işlemi sırasında bir hata meydana geldi.";
            }
        }
    }
} else {
    $conn = new mysqli("localhost","root","", "finalproject");
    if($conn->connect_error){
        $ERROR_MESSAGE = "Veritabanına bağlanılamadı. Lütfen sayfayı yeniden yükleyin.";
        exit;
    }

    if(!isset($_GET['productID'])){
        $ERROR_MESSAGE = "Geçersiz ürün.";
        header("Refresh: 5; url: index.php");
    }
    else {
        $ID = $_GET['productID'];
        $query = "SELECT Name, ImageName, Description, Url FROM `products` WHERE ID = '$ID' ";
        $result = $conn->query($query);
        if($result && $result->num_rows == 1){
            $row = $result->fetch_assoc();
            $NAME = $row["Name"];
            $IMAGENAME = $row["ImageName"];
            $DESCRIPTION = $row["Description"];
            $URL = $row['Url'];
        } else {
            $ERROR_MESSAGE = "Geçersiz ürün.";
            header("Refresh: 5; url: index.php");
        }
    }

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
        <h2>Ürün Güncelle</h2>
        <form action='updateproduct.php' method='post'>
            <input type="hidden" value="<?= $ID ?>" name="productid">
            <table>
                <?php
                if(!empty($ERROR_MESSAGE)){
                    echo "<tr><td align='center' colspan='2'><b style='color:red'>". $ERROR_MESSAGE ."</b></td></tr>";
                }
                ?>
                <tr><td style="color:white" width="%25">Ad: </td><td width="85%"><input style="width: 100%;" type='text' name='name' size='20' maxlength='150' value="<?= $NAME ?>"></td></tr>
                <tr><td style="color:white" width="%25">Bağlantı: </td><td width="85%"><input style="width: 100%;" type='text' name='url' size='20' maxlength='150' value="<?= $URL ?>"></td></tr>
                <tr><td style="color:white" width="%25">Resim Adı: </td><td width="85%"><input style="width: 100%;" type='text' name='imagename' size='20' maxlength='150' value="<?= $IMAGENAME ?>"></td></tr>
                <tr><td style="color:white" colspan="2">Açıklama;</td></td></tr>
                <tr><td colspan="2"><textarea style="width: 100%;" name='description' rows="10"><?= $DESCRIPTION ?></textarea></td></td></tr>
                <tr><td colspan="2" align='center'><input type='submit' value='GÜNCELLE'>  <a href="index.php">İptal</a></td></tr>
            </table>
        </form>
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
