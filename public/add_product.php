<?php
include("auth_check.php");
session_start();
require '../config/db.php';


$urunad_=$_POST['urunad_'];
$aciklama=$_POST['aciklama'];
$fiyat=$_POST['fiyat'];


if($_FILES['resim']['error']===0){
    $klasor="uploads/";
    if(!is_dir($klasor))mkdir($klasor);


    $dosyad=uniqid()."_".basename($_FILES["resim"]["name"]);
    $yol=$klasor.$dosyad;
    move_uploaded_file($_FILES["resim"]["tmp_name"],$yol);
}else{
    die("görsel yüklenemedi.");
}

$stmt=$db->prepare("INSERT INTO urunler(urun_adi,aciklama,fiyat,resim_yolu) VALUES (?,?,?,?)");
$stmt->execute([$urunad_,$aciklama,$fiyat,$yol]);

header("location: users_panel.php");
exit;

?>