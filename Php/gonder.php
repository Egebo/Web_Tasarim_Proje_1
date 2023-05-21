<?php

if (!$_POST) {
    echo ("Yanlış Sayfaya Geldiniz");
} else {
    $isim_soyisim = $_POST["isim-soyisim"];
    $e_posta = $_POST["mail"];
    $konu = $_POST["konu"];
    $mesaj = $_POST["mesaj"];
    $ip = $_SERVER["REMOTE_ADDR"];
    if (!$isim_soyisim) {
        echo ("İsim Soyisim Boş Bırakılamaz");
    } else {
        if (!$e_posta) {
            echo ("E Posta Boş Bırakılamaz");
        } else {
            if (!$konu) {
                echo ("Konu Boş Bırakılamaz");
            } else {
                if (!$mesaj) {
                    echo ("Mesaj Boş Bırakılamaz");
                } else {
                    echo ("<b> İsim Soyisim: </b>" . $isim_soyisim . "<br>");
                    echo ("<b> E Posta: </b>" . $e_posta . "<br>");
                    echo ("<b> Konu: </b>" . $konu . "<br>");
                    echo ("<b> Mesaj: </b>" . $mesaj . "<br>");
                    echo ("<b> IP: </b>" . $ip . "<br>");
                }
            }
        }
    }
}



?>