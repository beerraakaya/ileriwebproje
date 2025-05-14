<?php

require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username=$_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // Varsayılan olarak admin değil
   // $is_admin = 0;

    // E-posta daha önce kullanılmış mı kontrol et
    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    if ($stmt->rowCount() > 0) {
        $message= "Bu e-posta zaten kayıtlı.";
    } else {
        // Yeni kullanıcıyı ekle
        $stmt = $db->prepare("INSERT INTO users (email, password,role, is_admin) VALUES (:email, :password, :role,:is_admin)");
        $stmt->execute([
            'username'=>$username,
            'email' => $email,
            'password' => $password,
            'role'=>$role,
            'is_admin' => $is_admin
        ]);
        $message= "Kayıt başarılı!";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KAYIT SAYFASI</title>
    <style>
        form{
            background-color: wheat;
            position:absolute;
            border-radius: 12px;
            top: 50%;
            left:50%;
            width: 300px;
            box-shadow: 0 5px 20px rgba(0,0,0,1);
            padding: 30px;
            transform: translate(-50%,-50%);
        }
        #rol,button{
            display: flex;
            flex-direction: column;
            justify-content:center ;
            background-color: darkgrey;
        }
       
    </style>
</head>
<body> 
    <form method="POST" action="">
    <h2>KAYIT OL</h2>
    
    <i class="fas fa-user" style="font-size: 15px; color: #333;"></i>
    <input type="text" name="username" placeholder="İsim" required><br>

   <i class="far fa-envelope" style="font-size: 15px; color: #333;"></i>
   <input type="email" name="email" placeholder="E-Posta" required><br>

   <i class="fas fa-lock" style="font-size: 15px; color: #333;"></i>
    <input type="password" name="password" placeholder="Şifre" required style="margin-top: 10px;">

    <select name="role" id="rol" required style="margin-top: 10px;">
        <option value="Musteri">Müşteri</option>
        <option value="Satici">Satıcı</option>
    </select>

    <button type="submit" style="margin-top: 10px;">Kayıt Ol</button>
    <a href="index.php">Giriş Yapın</a>
    
    <?php if(isset($message))echo"<divclass='message'>$message<divclass=>"; ?>
</form>
</body>
</html>
