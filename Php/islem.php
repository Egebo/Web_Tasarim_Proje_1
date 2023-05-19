<?php
ob_start();
session_start();

require "baglan.php";


if (isset($_POST['kayit'])) {
    $mail = $_POST["mail"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password_again = @$_POST["password_again"];

    if (!$mail) {
        echo "Lütfen Mailinizi Girin";
    } elseif (!$username) {
        echo "Lütfen Kullanıcı Adınızı Girin";
    } elseif (!$password || !$password_again) {
        echo "Lütfen Şifrenizi Girin";
    } elseif ($password != $password_again) {
        echo "Girdiğiniz Şifreler Aynı Değil";
    } else {
        //veritabanı kayıt işlemi
        $sorgu = $db->prepare("INSERT INTO users SET user_mail=? ,user_name=?, user_password=?");
        $ekle = $sorgu->execute([
            $mail,$username, $password
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
    $mail = $_POST["mail"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (!$username) {
        echo "kullanıcı adını giriniz";
    } elseif (!$password) {
        echo "şifrenizi girin";
    } else {
        $kullanici_sor = $db->prepare("SELECT * FROM users WHERE user_mail=? && user_name=? && user_password=?");
        $kullanici_sor->execute([
            $mail,$username, $password
        ]);
        
         $say=$kullanici_sor->rowCount();
        if($say>=1){
            $_SESSION["mail"]=$mail;
            $_SESSION["username"]=$username;
            echo "Giriş Başarılı: Siteye yönlendiriliyorsunuz: $username"; 
            header("Refresh:2; url=../AnaSayfa.html");
        }else{
            echo "Giriş bilgilerinde bir yanlışlık var. Lütfen Tekrar Deneyiniz";
        }
    }
}
