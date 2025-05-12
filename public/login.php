
<?php
if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['is_admin'] = $user['is_admin']; // Yeni

    if ($remember) {
        $token = bin2hex(random_bytes(16));
        setcookie("remember_token", $token, time() + (86400 * 30), "/");
        $stmt = $conn->prepare("UPDATE users SET remember_token = :token WHERE id = :id");
        $stmt->execute(['token' => $token, 'id' => $user['id']]);
    }

    
    if ($user['is_admin']) {
        header("Location: admin_panel.php");
    } else {
        header("Location: dashboard.php");
    }
    exit;
}
?>