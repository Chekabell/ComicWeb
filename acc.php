<?php 
    session_start();
    //$_SESSION["test"] = '123';
    //$_SESSION["testHash"] = '';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="acc.css">
    <link rel="stylesheet" href="header.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebComic</title>
</head>
<body>
    <?php include "header.php"?>
    <section>
        <?if ($_SESSION['nickname'] == ''){
            if($_SESSION['needReg']){
                include "register.php";
            } else {
                include "login.php";
            }
        } else {?>
            ЗАГЛУШКА ЗАГЛУШКА ЗАГЛУШКА
            ЗАГЛУШКА ЗАГЛУШКА ЗАГЛУШКА
            ЗАГЛУШКА ЗАГЛУШКА ЗАГЛУШКА
        <?}?>
    </section>
</body>
</html>