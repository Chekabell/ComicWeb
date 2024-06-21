    <?php include "PHPforAssembling\\header.php"?>
    <section>
        <div class="content content-mod">
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
        </div>
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
