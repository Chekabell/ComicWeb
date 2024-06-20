<?
session_start();
$_SESSION['nickname'] = '';
$_SESSION['editor'] = false;
header('Location: http://comicweb/index.php');
exit();
?>
