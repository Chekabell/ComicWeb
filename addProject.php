<?session_start()?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS\\main.css">
    <link rel="stylesheet" href="CSS\\addProject.css">
    <link rel="stylesheet" href="CSS\\header.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebComic</title>
</head>
<body>
    <?php include "PHPforAssembling\\header.php"?>
    <section>
        <form enctype="multipart/form-data" action = "PHPscripts\\loadProject.php" method = "POST">
            <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
            <input name="userfile" type="file" accept = "image/png, image/jpeg, image/jpg" />
            <input type = "text" name = "project_name" placeholder="Название проекта" value="<?if(isset($_COOKIE['project_name']) && '' !== $_COOKIE['project_name']) echo $_COOKIE['project_name']?>" />
            <input type = "text" name = "description" placeholder="Краткое описание" value="<?if(isset($_COOKIE['description']) && '' !== $_COOKIE['description']) echo $_COOKIE['description']?>" />
            <input type = "text" name = "average_rating" placeholder="Средний рейтинг" value="<?if(isset($_COOKIE['average_rating']) && '' !== $_COOKIE['average_rating']) echo $_COOKIE['average_rating']?>" />
            <input type = "url" name = "url_read" placeholder="Ссылка на первую главу для прочтения" value="<?if(isset($_COOKIE['url_read']) && '' !== $_COOKIE['url_read']) echo $_COOKIE['url_read']?>" />
            <button type = "submit">Загрузить</button>
        </form>
    </section>
</body>
<script>
    header = document.querySelector('header');
    section = document.querySelector('section');
    section.style.top = header.offsetHeight + 20 + 'px';
    window.addEventListener('resize', function(){
        section.style.top = header.offsetHeight + 20 + 'px';
    })
</script>
</html>