<?
session_start();
require_once 'dbConnect.php';
$db->query("UPDATE mainschem.account SET editor = true WHERE nickname = " . $db->quote($_SESSION['nickname']));
$_SESSION['editor'] = true;
header('Location: http://comicweb/acc.php');
exit();