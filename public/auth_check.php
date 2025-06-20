<?php 

if(session_status()===PHP_SESSION_NONE)
    {
        session_start();
    }
$timeout=600;

if(isset($_SESSION['last_activity']) ){
    if (time() - $_SESSION['last_activity'] > $timeout){
        session_unset();
        session_destroy();
        header("Location:index.php?timeout=1");
        exit;
} 
}

$_SESSION['last_activity']=time();

if(isset($_SESSION['username'])) {
    header("Location: users_panel.php");
    exit;
}

?>