<?php
$host="localhost";
$dbname="urun_satis";
$username="root";
$password="";

try{
    $db=new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username,$password);
    //hata modunu ayarlama
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    die("Veritabanı bağlantı hatası ". $e->getMessage());
}
?>