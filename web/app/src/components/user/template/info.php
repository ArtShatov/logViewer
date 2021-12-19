<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет пользователя</title>
</head>
<body>
    <h1>Информация о пользователе</h1>
    <table border="1">
        <tr>
            <td>Username</td>
            <td><?=$username?></td>
        </tr>
        <tr>
            <td>email</td>
            <td><?=$email?></td>
        </tr>
        <tr>
            <td>ФИО</td>
            <td><?=$fio;?></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <a href="index.php?component=user&action=edit">Изменить</a>
                <a href="index.php?component=user&action=logout">Выйти</a>
            </td>
        </tr>
    </table>

</body>
</html>