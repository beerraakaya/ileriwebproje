<?php
include("auth_check.php");
session_start();
require '../config/db.php';

if($_SERVER['REQUEST_METHOD']==='POST'&& isset($_POST['urun_id'])){
    $id=intval($_POST['urun_id']);
    
    $stmt=$db->prepare("DELETE urunler WHERE id= :id");
    if($stmt->execute(['id'=>$id])){
        echo "ürün tamamen silindi";
    } else{
    echo "ürün silinirken hata oluştu.";
}

}else{
    echo "geçersiz istek";
}

?>