<?php session_start();
require_once 'PHPscripts\\dbConnect.php';
$sth = $db->query("SELECT project_name, description, average_rating, url_read FROM mainschem.projects WHERE id_project = " . $db->quote($_GET['id']));
$jsonForInfoProject = json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
$infoProject = json_decode($jsonForInfoProject, true);
include "PHPforAssembling\\header.php";?>
    <section style = "background-image: linear-gradient(to bottom, rgba(0,0,0,0.7) 0%,rgba(0,0,0,0.8) 20%, rgba(0,0,0,0.9) 40%,var(--background-color) 60%), url(IMG/PROJECT_PHOTO/<?echo ($_GET['id'].'.png')?>);">
        <div class = "content content-project">
            <div id = "project-img">
                <img src = "IMG/PROJECT_PHOTO/<?echo ($_GET['id'].'.png')?>"/>
                <div id = "button-read">Читать</div>
            </div>
            <div id = "info">
                <div id = "info-title">
                    <h1><?echo $infoProject[0]['project_name']?></h1>
                </div>
                <div id = "info-desctiption">
                    <h3>Описание</h3>
                    <p><?echo $infoProject[0]['description']?></p>
                </div>
            </div>
        </div>
    </section>
</body>

<script>
    let url = "<?echo ($infoProject[0]['url_read']);?>";
    document.querySelector('#button-read').addEventListener("click", function(){
        window.location.href = url;
    });
    section = document.querySelector('section');
    document.addEventListener('resize-padding', function(){
        section.style.paddingTop = header.offsetHeight + 20 + 'px';
    })
</script>
</html>
