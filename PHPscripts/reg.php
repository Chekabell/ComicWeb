<?php
if ($_POST["password"] === $_POST["password2"]){
    require_once "dbConnect.php";
    $sth = $db->prepare("INSERT INTO mainschem.account (nickname,email,password) VALUES(:nickname,:email,:password)");
    if($sth->execute([':nickname' => $_POST['nickname'], ':email' => $_POST['email'],':password' => password_hash($_POST['password'], PASSWORD_DEFAULT)])){
        $_SESSION['nickname'] = $_POST['nickname'];
        header('Location: http://comicweb/index.php');
        exit();
    }
} else {
    $_SESSION['message'] = 'Пароли не совпадают!';
    header('Location: http://comicweb/acc.php?reg=1');
    exit();
}
?>