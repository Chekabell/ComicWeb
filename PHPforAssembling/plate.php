<div id = "plate-<?echo$i?>">
    <div class = "plate-img">
        <img src = "<?echo 'IMG/PROJECT_PHOTO/' . $objNames[$i]["id_project"] . '.png'?>">
    </div>
    <div class = "plate-description">
        <h3>&#9733 <?echo $objNames[$i]['average_rating']?></h3>
        <h1><?echo $objNames[$i]['project_name']?></h1>
        <p><?echo $objNames[$i]['description']?></p>
    </div>
</div>