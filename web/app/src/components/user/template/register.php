<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
</head>
<body>
<h2>Регистрация нового пользователя</h2>
<form method="post" action="index.php?component=user&action=register">
    <table border="1">
        <tr>
            <td><label for="email">email</label></td>
            <td><input type="email" name="email" value="<?=$email;?>" id="email" /></td>
        </tr>
        <tr>
            <td><label for="username">Логин</label></td>
            <td><input type="text" name="username" value="<?=$username;?>" id="username" /></td>
        </tr>
        <tr>
            <td><label for="fio">ФИО</label></td>
            <td><input type="text" name="fio" value="<?=$fio;?>"  id="fio" /></td>
        </tr>
        <tr>
            <td><label for="password"><?php echo (isset($user_id)) ? "Новый пароль" : "Пароль";?></label></td>
            <td><input type="password" name="password" value=""  id="password" /></td>
        </tr>
        <tr>
            <td><label for="password2">Повторите пароль</label></td>
            <td><input type="password" name="password2" value=""  id="password2" /></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="Отправить" /></td>
        </tr>
    </table>
</form>
</body>
</html>