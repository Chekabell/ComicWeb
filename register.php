<form action = "reg.php" method = "post">
    <input type = "text" name = "nickname" placeholder="Ваш никнейм">
    <input type = "email" name = "email" placeholder = "Ваша почта">
    <input type = "password" name = "password" placeholder="Ваш пароль">
    <input type = "password" name = "password2" placeholder="Подтвердите пароль">
    <button type = "submit">Отправить</button>
</form>
<?echo $_SESSION['message'];
$_SESSION['message'] = '';?>
<br>
<a href = 'acc-logScript.php'>Уже есть аккаунт?</a>