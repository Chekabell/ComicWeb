<?php
require_once "dbConnect.php";
$sth = $db->query("SELECT password FROM mainschem.account WHERE nickname = ".$db->quote($_POST['nickname']));
$data = $sth->fetch();
if ($data[0]){
    if (password_verify($_POST["password"], $data[0])){
        $_SESSION['nickname'] =  $_POST['nickname'];
        $_SESSION['message'] = 'Вы успешно вошли!';
        require "acc.php";
    } else {
        $_SESSION['message'] = "Неправильный пароль!";
        require "acc.php";
    }
}
?>