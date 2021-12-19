<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
</head>
<body>
<h2>Изменить данные</h2>
<?php if (!empty($errors)) : ?>
<p style="color: red">
    <?php foreach ($errors as $error) :?>
        <?=$error;?><br />
    <?php endforeach;?>
</p>
<?php endif; ?>
<form method="post" action="index.php?component=user&action=edit">
    <table border="1">
        <tr>
            <td><label for="fio">ФИО</label></td>
            <td><input type="text" name="fio" value="<?=$fio;?>"  id="fio" /></td>
        </tr>
        <tr>
            <td><label for="password">Пароль</td>
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