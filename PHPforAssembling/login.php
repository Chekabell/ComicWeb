<form action = "/PHPscripts/auth.php" method = "post">
    <input type = "text" name = "nickname" placeholder="Ваш никнейм">
    <input type = "password" name = "password" placeholder="Ваш пароль">
    <button type = "submit">Войти</button>
</form>
<?
echo $_SESSION['message'];
$_SESSION['message'] = '';
?>
<br>
<span id = "redirect">Ещё нет аккаунта?</span>
<script>
    document.getElementById('redirect').addEventListener("click", function(){
        window.location.href = 'acc.php?reg=1';
    })
</script>