<?session_start()?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400..900&display=swap" rel="stylesheet">
    <link rel= "stylesheet" href="CSS\\main.css">
    <link rel= "stylesheet" href="CSS\\acc.css">
    <link rel= "stylesheet" href="CSS\\header.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebComic</title>
</head>
<body>
    <?php include "PHPforAssembling\\header.php"?>
    <section>
        <?if ($_SESSION['nickname'] == ''){
            if($_GET['reg'] == 1){
                include "PHPforAssembling\\register.php";
            } else {
                include "PHPforAssembling\\login.php";
            }
        } else {?>
            <div id = "acc-plate">
                <div id = "acc-plate-avatar">
                    <img src = "IMG\\PROFILE_PHOTO\\<?
                        if ($objProfile[0]['avatar'] == 'true')
                            echo $objProfile[0]['id_user'] . '.png';
                        else{
                            echo 'noavatar.png';
                        }
                    ?>">
                    <form enctype="multipart/form-data" action="PHPscripts\\loadAvatar.php" method="POST">
                        <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                        <input name="userfile" type="file" accept = "image/png" />
                        <input type="submit" value="Отправить файл" />
                    </form>
                </div>
                <div id = "acc-plate-info">
                    <span>Имя:</span><?echo $_SESSION['nickname']?>
                </div>
            </div>
            <span id = "get-editor">Получить возможность управления проектами</span>
            <script>
                document.getElementById('get-editor').addEventListener("click", function(){
                    window.location.href = 'PHPscripts\\getEditor.php';
                })
            </script>
        <?}?>
    </section>
</body>
<script>
    header = document.querySelector('header');
    section = document.querySelector('section');
    section.style.top = header.offsetHeight+20 + 'px';
    window.addEventListener('resize', function(){
        section.style.top = header.offsetHeight+20 + 'px';
    })
</script>
</html>
