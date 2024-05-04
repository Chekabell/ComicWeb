<form action = "auth.php" method = "post">
    <input type = "text" name = "nickname" placeholder="Ваш никнейм">
    <input type = "password" name = "password" placeholder="Ваш пароль">
    <button type = "submit">войти</button>
</form>
<?
echo $_SESSION['message'];
$_SESSION['message'] = '';
?>
<br>
<a href = 'acc-regScript.php'>Ещё нет аккаунта?</a>
