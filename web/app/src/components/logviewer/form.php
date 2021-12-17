<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Добавление записи</title>
</head>
<body>
    <form method="post">
        <table>
            <tr>
                <td>Дата</td>
                <td><input type="text" name="ts" value="<?=$ts;?>" style="width: 200px"/></td>
            </tr>
            <tr>
                <td>Тип записи</td>
                <td>
                    <select name="type" style="width: 200px">
                        <?php for($i = 1 ; $i < 11;$i++) : ?>
                            <option value="<?=$i?>" <?php echo ($i == $type) ? "selected=selected": "";?>><?=$i;?></option>
                        <?php endfor; ?>
                    </select>
                </td>

            </tr>
            <tr>
                <td colspan="2">
                    Текст:<br />
                    <textarea name="message" style="width: 300px"><?=$message;?></textarea>
                </td>
            </tr>
        </table>
        <input type="submit" value="Сохранить" />
    </form>
</body>
</html>