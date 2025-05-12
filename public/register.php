<?php
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // Varsayılan olarak admin değil
    $is_admin = 0;

    // E-posta daha önce kullanılmış mı kontrol et
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    if ($stmt->rowCount() > 0) {
        echo "Bu e-posta zaten kayıtlı.";
    } else {
        // Yeni kullanıcıyı ekle
        $stmt = $conn->prepare("INSERT INTO users (email, password, role, is_admin) VALUES (:email, :password, :role, :is_admin)");
        $stmt->execute([
            'email' => $email,
            'password' => $password,
            'role' => $role,
            'is_admin' => $is_admin
        ]);
        echo "Kayıt başarılı!";
    }
}
?>
