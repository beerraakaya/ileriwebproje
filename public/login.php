
<?php
include("auth_check.php");
require '../config/db.php';


if($_SERVER['REQUEST_METHOD']=='POST'){
    $email=$_POST['email']?? null;
    $password=$_POST['password']?? null;
    $remember=isset($_POST['remember']);

    $stmt=$db->prepare("SELECT * FROM users WHERE email= :email");
    $stmt->execute(['email'=>$email]);
    $users=$stmt->fetch(PDO::FETCH_ASSOC);


    if ($users && password_verify($password, $users['password'])) {
    $_SESSION['user_id'] = $users['id'];
    $_SESSION['role'] = $users['role'];
    $_SESSION['is_admin'] = $users['is_admin']; 

    if ($remember) {
        $token = bin2hex(random_bytes(16));
        setcookie("remember_token", $token, time() + (86400 * 30), "/");
        $stmt = $db->prepare("UPDATE users SET remember_token = :token WHERE id = :id");
        $stmt->execute(['token' => $token, 'id' => $users['id']]);
    }

    
    if (isset($_SESSION['user_id'])) {
        header("Location: users_panel.php");
    } else{
        echo " Şifreniz yanlış";
    }
    exit;
    } 
    
}
?>