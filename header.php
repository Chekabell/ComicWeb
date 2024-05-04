<header>
    <div class = 'head-left'>
        <a href="index.php">главная</a>
        <a>топы</a>
        <a>поиск</a>
    </div>
    <div class = 'head-right'>
        <a>закладки</a>
        <a>свап темы</a>
        <?
            if ($_SESSION['nickname'] !== ''){?>
                <a href="acc.php"><?php echo $_SESSION['nickname'] ?></a>
            <?} else {?>
                <a href="acc.php">войти</a>
            <?}
        ?>
    </div>
</header>