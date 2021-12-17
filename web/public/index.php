<?php
require_once '../app/config.php';
require_once '../app/src/library/db.php';
require_once '../app/src/library/request.php';

$db = new DB(DB_HOST , DB_USER , DB_PASSWORD , DB_DATABASE);
$request = new Request();

//Ищем установленные компоненты
$avalibleComponents  = scandir('../app/src/components/');
foreach ($avalibleComponents as $index => $value) {
    if (in_array($value , array('.', '..'))) {
        unset($avalibleComponents[$index]);
    }
}

$component = ((isset($request->get['component']) and ($request->get['component'] !=='')) ? $request->get['component'] : DEFAULT_COMPONENT);
$action = ((isset($request->get['action']) and ($request->get['action'] !=='')) ? $request->get['action'] : 'index');

if (!in_array($component , $avalibleComponents)) {
    $component = 'error';
    $action = 'index';
}
$controllerFileName = '../app/src/components/' . $component . '/controller.php';

require_once $controllerFileName;
if (!file_exists($controllerFileName)) {
    die('Error: Could not load controller: ' . $controllerFileName);
}

$clasName = $component . 'Controller';

if (!class_exists($clasName)) {
    die('Error: Class not exists: ' . $clasName);
}

//Создаем модель, в нее инжектим коннектор БД
//Создаем контроллер. В него инжектим Реквест, Модель.

//$controller = new ();