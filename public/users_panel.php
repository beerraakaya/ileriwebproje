<?php

require '../config/db.php';
require 'login.php';
$urunsorgu=$db->prepare("SELECT * FROM urunler WHERE aktif = 1 ORDER BY id DESC");
$urunsorgu->execute();
$urunler=$urunsorgu->fetchAll(PDO::FETCH_ASSOC);

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
        #profilebox{ border: 2px,  solid black;
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

        #addurun{
            border: 2px, solid black;
            display: none;
            position: absolute;
            top: 30px;
            left: 0;
            background-color:wheat;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,2);
            min-width: 200px;
            width: auto;
            z-index: 1000;
            
        }

        .urunliste{ 
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: left;
        
        }

        .urun{
            display: inline-block;
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px 0;
            border-radius: 8px;
            background-color: #fff;
            width: fit-content;
            text-align: center;
        }
        .urun img{
            width: 225px; ;
            height: 225px; ;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
            display: block;
            margin-left: auto;
            margin-right: auto;
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
        <div style="display: flex; justify-content: space-between;align-items: center; position: relative; padding: 10px;">
            
            <i class="fas fa-shopping-cart" id="urunekleIcon" style="font-size: 30px; color: #555; cursor: pointer">Ürün EKLE</i>
            <div id="addurun" >
              <form action="add_product.php" method="POST" enctype="multipart/form-data"> 
              <p><strong>Ürün Görseli: </strong></p>
              <input type="file" name="resim" accept="image/*" required> <br><br>
                <label for="">Ürün Adı:</label><br>
                <input type="text" name="urunad_" required><br><br>

                <label for="">Fiyat</label><br>
                <input type="number" name="fiyat" step="0.01" required><br><br>

                <label for="">Açıklama</label><br>
                <textarea name="aciklama" id="" required></textarea><br><br>

                <button type="submit">Tanıtıma Çıkar</button>
                <button type="button" onclick="formgizle()">İptal</button>
            </form>
            </div>

            <i class="fas fa-user" id="profileIcon" style="font-size: 30px; color: #555">Profilim</i>

            <div id="profilebox">
                <p><strong>Ad-Soyad:</strong><?=htmlspecialchars($users['username']);?></p>
                <p><strong>Email:</strong><?=htmlspecialchars($users['email']);?></p>
            <button onclick="window.location.href='logout.php'">Çıkış yap</button><br>
            <a href="user_functions.php">Şifre Değiştirme</a>
            </div>
            </div>  
           
            <div class="urunliste">
                <?php foreach($urunler as $urun):?>
                <div class="urun" style="background-color: antiquewhite" data-id="<?=$urun['id']?>">
                    <img src="<?php echo htmlspecialchars($urun['resim_yolu']);?>" alt="Ürün Görseli">
                    <h4><?php echo htmlspecialchars($urun['urun_adi']) ;?></h4>
                    <p><?php echo htmlspecialchars($urun['aciklama']);?></p>
                    <strong><?php echo number_format($urun['fiyat'],3)?>TL</strong><br>

                   
                        <input type="hidden" name="urun_id" value="<?=$urun['id']?>">
                        <button type="submit" onclick="urunsil(<?=$urun['id']?>)" style="margin-top: 5px; padding: 3px;">Tanıtımdan kaldır </button>
                    
                </div>
                <?php endforeach; ?>
              
            </div>  
    
    </div>
    <script>
        const profileIcon=document.getElementById('profileIcon');
        const profilebox= document.getElementById('profilebox');
        const urunekleIcon=document.getElementById('urunekleIcon');
        const addurun=document.getElementById('addurun');

        profileIcon.addEventListener('click',() => {
            profilebox.style.display=(profilebox.style.display==='block')?'none':'block';          
        });

        document.addEventListener('click',function(e) {
            if(!profileIcon.contains(e.target) && !profilebox.contains(e.target)){
                profilebox.style.display='none';
            }            
        });
        
        
        urunekleIcon.addEventListener('click',()=> {
            addurun.style.display=(addurun.style.display==='block')?'none':'block';
        })
        function formgizle(){
            addurun.style.display='none';
        } 
        function urunsil(id){
            if(!confirm("ÜRÜNÜ SİLMEK İSTEDİĞİNE EMİN MİSİN")) return;

            fetch("delete_product.php",{
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "urun_id="+encodeURIComponent(id)
            })
            .then(response=>response.text())
            .then(data=>{
                const urunDiv= document.querySelector('[data-id="'+id+'"]');
                if(urunDiv){
                    urunDiv.remove();
                }

                alert(data);
            })
            .catch(error=>{
                console.error("Hata:",error);
                alert("Bir hata oluştu ürün silinemedi");
            });
        }
       
       
        
    </script>
</body>
</html>