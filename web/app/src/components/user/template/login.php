<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Страница входа</title>
</head>
<body>
<h2>Страница входа</h2>
<?php if (!empty($error)) : ?>
    <p style="color: red"><?=$error;?></p>
<?php endif ?>
<form method="post" action="/index.php?component=user&action=login">
    <table border="1">
        <tr>
            <td><label for="username">Емеил или имя пользователя</label></td>
            <td><input type="text" id="username" name="username" value="" /></td>
        </tr>
        <tr>
            <td><label for="password">Пароль</label></td>
            <td><input type="password" id="password" name="password" /></td>
        </tr>
        <tr>
            <td><a href="/index.php?component=user&action=register">Регистрация</a></td>
            <td align="right"><input type="submit" value="Войти!" /></td>
        </tr>
    </table>
</form>
</body>
</html>