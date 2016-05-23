<?php

//Oturum bilgisini saklamak için Session başlatılıyor.
session_start();

//Sayfada kullanılacak değişkenler tanımlanıyor.
@$ERROR_MESSAGE = "";
@$USERNAME = "";
@$PASSWORD = "";

function login($username, $password){
    $conn = new mysqli("localhost","root","", "finalproject");
    if($conn->connect_error){
        return -2;
    }

    $query = "SELECT ID FROM `users` WHERE Username = '$username' AND BINARY Password = '$password'";
    $result = $conn->query($query);
    if($result && $result->num_rows == 1){
        $row = $result->fetch_assoc();
        return $row["ID"];
    } else {
        return -1;
    }
}

//Eğer sayfa post edilmişse yani 'OTURUM AÇ' butonuna tıklandıysa.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Sayfa üzerindeki değerler değişkenlere atanıyor.
    $USERNAME = $_REQUEST['username'];
    $PASSWORD = $_REQUEST['password'];
    //Bütün bilgiler kontrol ediliyor.
    if (empty($USERNAME) || empty($PASSWORD)) {
        //Bilgilerde eksik olduğu için uyarı mesajı atanıyor. Bu mesaj kayıt formu üzerinde görüntüleniyor.
        $ERROR_MESSAGE = "Bütün bilgileri eksiksiz girin.";
    } else {
        //Kayıt metodu çağırılıyor.
        $userID = login($USERNAME, $PASSWORD);
        if($userID > 0){
            //Session üzerinde kullanıcı ID'sini saklamak için alan kaydediliyor.
            $_SESSION["userID"] = $userID;
            $_SESSION["username"] = $USERNAME;
            //Yönetim sayfasına yönlendirme yapılıyor.
            header("location: admin\index.php");
        } else {
            if($userID == -1){
                $ERROR_MESSAGE = "Kullanıcı adı veya şifre yanlış.";
            } else if ($userID == -2){
                $ERROR_MESSAGE = "Veritabanına bağlanılamadı.";
            }
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
            <?php
            if(isset($_SESSION["userID"]) && $_SESSION["userID"] > 0){
                header("location: admin\index.php");
            } else {
                echo "<div class='right'><a href=\"register.php\">Kaydol</a></div>";
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
        <div id="auth_container">
            <div id="login_container">
                <table align='center' cellpadding='3' cellspacing='3' border='5'>
                    <tr><td align='center' bgcolor='eeeeee' colspan='2'><b>Oturum Aç</b></td></tr>
                    <?php
                    if(!empty($ERROR_MESSAGE)){
                        echo "<tr><td align='center' bgcolor='eeeeee' colspan='2'><b style='color:red'>". $ERROR_MESSAGE ."</b></td></tr>";
                    }
                    ?>
                    <form action='login.php' method='post'>
                        <tr><td bgcolor='cccccc'>Kullanıcı Adı:</td><td bgcolor='eeeeee'><input type='text' name='username' size='20' maxlength='150' value="<?= $USERNAME ?>"></td></tr>
                        <tr><td bgcolor='cccccc'>Şifre:</td><td bgcolor='eeeeee'><input type='password' name='password' size='20' maxlength='50'></td></tr>
                        <tr><td align='center' bgcolor='eeeeee' colspan='2'><input type='submit' value='OTURUM AÇ'></td></tr>
                    </form>
                </table>
            </div>
        </div>
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