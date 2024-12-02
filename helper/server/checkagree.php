<?php 
session_start(); 
if (isset($_POST['check'])) {
    if (!empty($_POST['check'])) {
        $_SESSION['user_agreed'] = true; 
        header('location: ../../choose.php');
        exit();
    } else {
        $_SESSION['user_agreed'] = false; 
        exit();
    }
} else {
}
?>
