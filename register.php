<?php

session_start();

//Sayfada kullanılacak değişkenler tanımlanıyor.
@$ERROR_MESSAGE = "";
@$USERNAME = "";
@$EMAIL = "";
@$PASSWORD = "";

//Veritabanına belirtilen bilgilerle kullanıcı oluşturur.
function register($username, $email, $password){
    $conn = new mysqli("localhost","root","", "finalproject");
    if($conn->connect_error){
        echo "<h2 style='color:red; text-align: center'>İşlem sırasında bir hata meydana geldi. Hata: $conn->error;.</h2>";
        exit;
    }

    $cmd = $conn->prepare("INSERT INTO `users` (`username`,`email`,`password`) values (?,?,?)");
    $cmd->bind_param("sss", $username, $email, $password);

    if($cmd->execute() === TRUE){
        return 1;
    } else {
        echo "<h2 style='color:red; text-align: center'>İşlem sırasında bir hata meydana geldi. Hata: $cmd->error;.</h2>";
        exit;
    }
}

//Eğer sayfa post edilmişse yani 'KAYDOL' butonuna tıklandıysa
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Sayfa üzerindeki değerler değişkenlere atanıyor.
    $USERNAME = $_REQUEST['username'];
    $EMAIL = $_REQUEST['email'];
    $PASSWORD = $_REQUEST['password'];
    //Bütün bilgiler kontrol ediliyor.
    if (empty($USERNAME) || empty($EMAIL) || empty($PASSWORD)) {
        //Bilgilerde eksik olduğu için uyarı mesajı atanıyor. Bu mesaj kayıt formu üzerinde görüntüleniyor.
        $ERROR_MESSAGE = "Bütün bilgileri eksiksiz girin.";
    } else {
        //Kayıt metodu çağırılıyor.
        $result = register($USERNAME, $EMAIL, $PASSWORD);
        if($result == 1){
            //Giriş sayfasın yönlendirme işlemi yapılıyor.
            header("location: login.php");
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
                header("location: index.php");
            } else {
                echo "<div class='right'><a href=\"login.php\">Oturum Aç</a></div>";
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
    <div id="gorsel"><img src="content/img/gorsel.png" width="960" height="254" alt="Programlama Dilleri" /></div>
    <div id="icerik">
        <div id="auth_container">
            <div id="login_container">
                <table align='center' cellpadding='3' cellspacing='3' border='5'>
                    <tr><td align='center' bgcolor='eeeeee' colspan='2'><b>Kayıt Formu</b></td></tr>
                    <?php
                    if(!empty($ERROR_MESSAGE)){
                        echo "<tr><td align='center' bgcolor='eeeeee' colspan='2'><b style='color:red'>". $ERROR_MESSAGE ."</b></td></tr>";
                    }
                    ?>
                    <form action='register.php' method='post'>
                        <tr><td bgcolor='cccccc'>Kullanıcı Adı:</td><td bgcolor='eeeeee'><input type='text' name='username' size='20' maxlength='150' value="<?= $USERNAME ?>"></td></tr>
                        <tr><td bgcolor='cccccc'>E-Posta:</td><td bgcolor='eeeeee'><input type='text' name='email' size='20' maxlength='250' value="<?= $EMAIL ?>"></td></tr>
                        <tr><td bgcolor='cccccc'>Şifre:</td><td bgcolor='eeeeee'><input type='password' name='password' size='20' maxlength='50'></td></tr>
                        <tr><td align='center' bgcolor='eeeeee' colspan='2'><input type='submit' value='KAYDOL'></td></tr>
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