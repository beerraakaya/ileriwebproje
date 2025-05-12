<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş Yap</title>

    <style>
     .login-box {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 300px;
    background-color:  wheat;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }
    .group{
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
<div class="login-box">
    <h2 style="text-align: center;">HOŞ GELDİNİZ</h2>
 
    <div class="group">
        <label for="email">E-posta adresi: </label>
        <input type="email" name="email" required>
        <br>
        <label for="şifre" >Parola</label>
        <input type="password" name="şifre" required>
        <br>
        
     </div>
     <button>GİRİŞ YAP</button> 
    <br>
   <input type="checkbox" name="Beni hatırla">Beni Hatırla  <br><br>
   <a href="" style="margin-top:10px;">Parolanızı mı unuttunuz?</a><br>
   <a href="register.php">Kayıt olun</a>
</div>
 
</body>
</html>

