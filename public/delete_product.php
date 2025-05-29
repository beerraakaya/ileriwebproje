<?php
session_start();
require '../config/db.php';

if($_SERVER['REQUEST_METHOD']==='POST'&& isset($_POST['urun_id'])){
    $id=intval($_POST['urun_id']);
    
    $stmt=$db->prepare("UPDATE urunler SET aktif=0 WHERE id= :id");
    if($stmt->execute(['id'=>$id])){
        echo "ürün tamamen silindi";
    } else{
    echo "ürün silinirken hata oluştu.";
}

}else{
    echo "geçersiz istek";
}

?>