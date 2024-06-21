<?php include "PHPforAssembling\\header.php"?>
    <section>
        <div class = "content content-mod">
            <form enctype="multipart/form-data" action = "PHPscripts\\loadProject.php" method = "POST">
                <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                <input name="userfile" type="file" accept = "image/png, image/jpeg, image/jpg" />
                <input type = "text" name = "project_name" placeholder="Название проекта" value="<?if(isset($_COOKIE['project_name']) && '' !== $_COOKIE['project_name']) echo $_COOKIE['project_name']?>" />
                <input type = "text" name = "description" placeholder="Краткое описание" value="<?if(isset($_COOKIE['description']) && '' !== $_COOKIE['description']) echo $_COOKIE['description']?>" />
                <input type = "text" name = "average_rating" placeholder="Средний рейтинг" value="<?if(isset($_COOKIE['average_rating']) && '' !== $_COOKIE['average_rating']) echo $_COOKIE['average_rating']?>" />
                <input type = "url" name = "url_read" placeholder="Ссылка на первую главу для прочтения" value="<?if(isset($_COOKIE['url_read']) && '' !== $_COOKIE['url_read']) echo $_COOKIE['url_read']?>" />
                <button type = "submit">Загрузить</button>
            </form>
        </div>
    </section>
</body>
<script>
    section = document.querySelector('section');
    document.addEventListener('resize-padding', function(){
        section.style.paddingTop = header.offsetHeight + 20 + 'px';
    })
</script>
</html>