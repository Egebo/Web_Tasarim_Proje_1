<?php
ob_start();
session_start();

require "baglan.php";


if (isset($_POST['kayit'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password_again = @$_POST["password_again"];

    if (!$username) {
        echo "Lütfen Kullanıcı Adınızı Girin";
    } elseif (!$password || !$password_again) {
        echo "Lütfen Şifrenizi Girin";
    } elseif ($password != $password_again) {
        echo "Girdiğiniz Şifreler Aynı Değil";
    } else {
        //veritabanı kayıt işlemi
        $sorgu = $db->prepare("INSERT INTO users SET user_name=?, user_password=?");
        $ekle = $sorgu->execute([
            $username, $password
        ]);
        if ($ekle) {
            echo "Kayıt Başarılı, Yönlendiriliyorsunuz...";
            header('Refresh:2; url=index.php');
        } else {
            echo "Bir hata oluştu. Lütfen tekrar deneyin.";
        }
    }
}

if (isset($_POST['giris'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (!$username) {
        echo "kullanıcı adını giriniz";
    } elseif (!$password) {
        echo "şifrenizi girin";
    } else {
        $kullanici_sor = $db->prepare("SELECT * FROM users WHERE user_name=? || user_password=?");
        $kullanici_sor->execute([
            $username, $password
        ]);
        
         $say=$kullanici_sor->rowCount();
        if($say==1){
            $_SESSION["username"]=$username;
            echo "Giriş Başarılı: Siteye yönlendiriliyorsunuz..."; 
            header("Refresh:2; url=../AnaSayfa.html");
        }else{
            echo "Giriş bilgilerinde bir yanlışlık var. Lütfen Tekrar Deneyiniz";
        }
    }
}
