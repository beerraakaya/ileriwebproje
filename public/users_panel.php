<?php

require '../config/db.php';
require 'login.php';
if (isset($_SESSION['user_id'])) {
    $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $_SESSION['user_id']]);
    $users = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$users) {
        echo "Kullanıcı bulunamadı.";
        exit;
    }
} else {
    // Giriş yapılmamışsa giriş sayfasına yönlendir
    header("Location: index.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SATIŞ SAYFASI</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        #profilebox{ border: 5px, black;
            border-radius: 5px;
            display: none;
            position: absolute;
            top: 30px;
            right: 0;
            background-color: wheat;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,2);
            width: 200px;
            z-index: 1000;
        }
        #profilebox p{
            text-align: left;
        }
        #profilebox button,a{
            text-align: right;
        }
    </style>
 
</head>
<body>
    
    <div class="ust_bilgi">
        <div style="text-align: right; position: relative;">
            <i class="fas fa-user" id="profileIcon" style="font-size: 30px; color #555">Profilim</i>

            <div id="profilebox" style="display: none;">
                <p><strong>Ad-Soyad:</strong><?=htmlspecialchars($users['username']);?></p>
                <p><strong>Email:</strong><?=htmlspecialchars($users['email']);?></p>
            <button onclick="window.location.href='logout.php'">Çıkış yap</button><br>
            <a href="user_functions.php">Şifre Değiştirme</a>
            </div> 
           
        </div> 
    </div>
    <script>
        const icon=document.getElementById('profileIcon');
        const box= document.getElementById('profilebox');

        icon.addEventListener('click',() => {
           if (box.style.display==='none'|| box.style.display===''){ 
            box.style.display="block";
           }
           else{
            box.style.display="none";
           }
        });

        document.addEventListener('click',function(e) {
            if(!icon.contains(e.target) && !box.contains(e.target)){
                box.style.display='none';
            }
            
        });
    </script>
</body>
</html>