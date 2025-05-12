<?php
session_start();

// Oturum kontrolü
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    echo "Bu sayfaya erişim yetkiniz yok.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yönetici Paneli</title>
</head>
<body>
    <h1>Yönetici Paneline Hoş Geldiniz</h1>
    <p>Sadece admin yetkisine sahip kullanıcılar burayı görebilir.</p>

    <ul>
        <li><a href="tum-kullanicilar.php">Kullanıcıları Görüntüle</a></li>
        <li><a href="logout.php">Çıkış Yap</a></li>
    </ul>
</body>
</html>
