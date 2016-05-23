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
        <h1>Programlama Dilleri</h1>
        <p>Programlama dili, yazılımcının bir algoritmayı ifade etmek amacıyla, bir bilgisayara ne yapmasını istediğini anlatmasının tektipleştirilmiş yoludur.
            Programlama dilleri, yazılımcının bilgisayara hangi veri üzerinde işlem yapacağını, verinin nasıl depolanıp iletileceğini, hangi koşullarda hangi işlemlerin yapılacağını tam olarak anlatmasını sağlar.
            Şu ana kadar 150'den fazla programlama dili yapılmıştır.
            Bunlardan bazıları Pascal, Basic, C, C#, C++, Java, JavaScript, Cobol, Perl, PHP, Python, Ada, Fortran, Delphi ve Swift'tir. </p>
        <h2>Uygulama</h2>
        <p>Donanım ve yazılımın bir veya daha fazla yapılandırması o programı çalıştırmak için bir tür yol sağlar.
            Programlama dili uygulamasında iki yaklaşım vardır: Derleme ve yorumlama.
            Herhangi bir tekniği kullanarak bir programlama dili uygulamak mümkündür.
            Genellikle donanım üzerinde çalışanlar yazılım üzerinde yorumlananlardan daha hızlıdır.
            Yorumlanan programların performansını geliştirmek için anında derleme programları kullanılır.
            Derleyiciden gelen çıktı ya donanım tarafından ya da yorumlayıcı diye adlandırılan programlar tarafından çalıştırılır.
            Cihaza komut göndermeyi sağlayan, verileri cihaza aktarma stilidir.
            Şu anda hemen hemen tüm yazılım dilleri İngilizcedir.
            Bazı uygulamaların dili ise İspanyolca olarak kullanılmaya başlanmıştır.</p>
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