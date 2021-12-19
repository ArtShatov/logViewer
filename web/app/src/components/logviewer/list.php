<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Вывод логов</title>
</head>
<body>
<?php
$url = "/index.php?component=logviewer";
foreach ($filters as $key => $val) {
    $url .= "&filters[" . $key . "]=" . $val;
}
?>
<table border="1">
    <?php $hrow = ($orderby == 'DESC') ? '&#8595;':'&#8593;';?>
    <thead>
        <tr>
            <td colspan="3">
                <form id="filter">
                    Показать
                    <select name="filters[type]">
                        <option value="">Выбрать</option>
                        <?php foreach ($types as $type) : ?>
                            <option value="<?=$type['type']?>" <?php echo ($filters['type'] == $type['type']) ? "selected=selected" : ""?>><?=$type['type'];?></option>
                        <?php endforeach;?>
                    </select>
                    <button type="submit" form="filter">Показать</button>
                    <input type="hidden" name="component" value="logviewer" />
                </form>
                <a href="index.php?component=logviewer&action=form"/>Добавить запись</a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="<?=$url;?>&order=ts&orderby=<?php echo ($orderby == "ASC") ? "DESC": "ASC";?>">
                    Дата <?php echo ($order == 'ts') ? $hrow : "";?>
                </a>
            </td>
            <td>
                <a href="<?=$url;?>&order=type&orderby=<?php echo ($orderby == "ASC") ? "DESC": "ASC";?>">
                    Тип <?php echo ($order == 'type') ? $hrow : "";?>
                </a>
            </td>
            <td>Сообщение</td>
        </tr>
    </thead>
    <tbody>
        <?php if (count($rows) > 0) :?>
            <?php foreach ($rows as $row) : ?>
            <tr>
                <td><?=$row['ts']?></td>
                <td><?=$row['type']?></td>
                <td><?=$row['message']?></td>
            </tr>
            <?php endforeach;?>
        <?php endif; ?>
    </tbody>
    <tr>
        <td colspan="3" align="center">
            <?php for($i = 0;$i*$limit < $count;$i++) : ?>
                <a href="<?=$url;?>&order=<?=$order?>&orderby=<?=$orderby?>&start=<?=$i*$limit;?>"><?=($i+1);?></a>
            <?php endfor;?>
        </td>

    </tr>
    <tr>
        <td colspan="3" align="center">
            Всего: <?=$count?>, показано: <?php echo count($rows);?>
        </td>
    </tr>
</table>
</body>
</html>