<?php
include("auth_check.php");
require '../config/db.php';
require 'login.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $user_id=$_SESSION['user_id'];
    $eski= $_POST['eski_sifre'];
    $yeni= $_POST['yeni_sifre'];
    $yeni_tekrar=$_POST['yeni_sifre_tekrar'];

    if ($yeni!==$yeni_tekrar){
        echo "GİRDİĞİNİZ YENİ ŞİFRELER UYUŞMUYOR!";
        exit;
    }

    $stmt=$db->prepare("SELECT password FROM users WHERE id= :id");
    $stmt->execute(['id'=> $user_id]);
    $kullanici= $stmt->fetch(PDO::FETCH_ASSOC);

    if ($kullanici && password_verify($eski,$kullanici['password'])){
        $hashed= password_hash($yeni,PASSWORD_DEFAULT);
        $stmt=$db->prepare("UPDATE users SET password= ? WHERE id=?");
        $stmt->execute([$hashed,$user_id]);

        echo "<script>alert('Şifreniz Başarı ile Değiştirildi. Tekrar Giriş Yapınız.');
        window.location.href='index.php';
        </script>";
        
        exit();
    }else{
        echo "Eski Şifreniz Hatalı !";
        header("Location: user_functions.php?error=wrong");
        exit();
    }
}?>
 <?php if(isset($_GET['error'])&& $_GET['error']=='wrong'){
    echo "<script>alert('Eski şifreniz yanlış. Lütfen tekrar deneyiniz');</script>";
 }
 ?>
   

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Şifre Güncelleme</title>
    <style>
    div{ 
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 300px;
        background-color:  wheat;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;

    }
    button {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: darkgrey;
        width: 100px;
    }
    </style>
</head>
<body>
    
    
    <form method="POST" action="">
        <div>
            <label for="">Eski Şifre: </label> <input type="password" name="eski_sifre" required><br>
        
            <label for="">Yeni Şifre</label>
            <input type="password" name="yeni_sifre" required><br>

            <label for="">Yeni Şifre (Tekrar)</label>
            <input type="password" name="yeni_sifre_tekrar" required>

            <button type="submit">Şifreyi Güncelle</button>
        </div>
    </form>
    
</body>
</html>