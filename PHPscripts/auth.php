<?php
require_once "dbConnect.php";
$sth = $db->query("SELECT password, editor FROM mainschem.account WHERE nickname = " . $db->quote($_POST['nickname']));
$data = $sth->fetch();
if($data){
    if ($data[0]){
        if (password_verify($_POST["password"], $data[0])){
            $_SESSION['nickname'] =  $_POST['nickname'];
            $_SESSION['message'] = 'Вы успешно вошли!';
            if($data[1] == 'true') $_SESSION['editor'] = true;
            header("location: http://comicweb/index.php");
            exit();
        } else {
            $_SESSION['message'] = "Неправильный пароль!";
            header('location: http://comicweb/acc.php');
            exit();
        }
    }
}
else{
    $_SESSION['message'] = "Имени пользователя не существует!";
    header('Location: http://comicweb/acc.php');
    exit();
}
?>