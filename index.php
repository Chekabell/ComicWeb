<?php 
    session_start();
    if (!isset($_SESSION['nickname'])) $_SESSION['nickname'] = '';
    if (!isset($_SESSION['editor'])) $_SESSION['editor'] = false;
    $_SESSION['message'] = '';
    require "PHPscripts\\dbConnect.php";
    $sth = $db->query("SELECT id_project, project_name, description, average_rating, url_read FROM mainschem.projects");
    $quantityProjects = $sth->rowCount();
    $jsonforindex = json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
    $objNames = json_decode($jsonforindex, true);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS\\main.css">
    <link rel="stylesheet" href="CSS\\header.css">
    <link rel="stylesheet" href="CSS\\plate.css">
    <link rel="stylesheet" href="CSS\\mini-plate.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebComic</title>
</head>
<body>
    <?php include "PHPforAssembling\\header.php"?>
    <section>
        <div class = "hot-new">
            <?php
            for ($i = 0; $i < $quantityProjects && $i < 9; $i++){include "PHPforAssembling\\plate.php";}?>
        </div>
        <div class="main-agregator">
            <div class = "main-agregator-in"><?php for ($i = 0; $i < $quantityProjects && $i < 9; $i++){include "PHPforAssembling\\mini-plate.php";}?></div>
            <div class = "main-agregator-in"><?php for ($i = 0; $i < $quantityProjects && $i < 9; $i++){include "PHPforAssembling\\mini-plate.php";}?></div>
            <div class = "main-agregator-in"><?php for ($i = 0; $i < $quantityProjects && $i < 9; $i++){include "PHPforAssembling\\mini-plate.php";}?></div>
        </div>
    </section>
</body>
<script>
    let urls = <?echo json_encode($jsonforindex)?>;
    urls = JSON.parse(urls);
    document.querySelectorAll('.hot-new div').forEach(function(project) {
        let idElem = project.id.slice(-1);
        project.addEventListener("click", function (){
            window.location.href = 'projectPage.php?id=' + items[idElem]['id_project'];
        });
    });
    section = document.querySelector('section');
    document.addEventListener('resize-padding', function(){
        section.style.paddingTop = header.offsetHeight + 20 + 'px';
    })
</script>
</html>
