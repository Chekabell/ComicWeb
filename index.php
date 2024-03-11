<!DOCTYPE html>
<html lang="ru">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="plate.css">
    <link rel="stylesheet" href="mini-plate.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebComic</title>
</head>
<body>
    <?php include "header.php"?>
    <div class="hot-new">
        <?php for ($i=0; $i<9; $i++){include "plate.php";}?>
    </div>
    <div class="main-agregator">
        <div class = "main-agregator-in"><?php for ($i=0; $i<9; $i++){include "mini-plate.php";}?></div>
        <div class = "main-agregator-in"><?php for ($i=0; $i<9; $i++){include "mini-plate.php";}?></div>
        <div class = "main-agregator-in"><?php for ($i=0; $i<9; $i++){include "mini-plate.php";}?></div>
    </div>
</body>
</html>