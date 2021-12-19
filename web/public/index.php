<?php
require_once '../app/config.php';
require_once '../app/src/library/db.php';
require_once '../app/src/library/template.php';
require_once '../app/src/library/request.php';

$db = new DB(DB_HOST , DB_USER , DB_PASSWORD , DB_DATABASE);
$request = new Request();

//Ищем установленные компоненты
$availableComponents  = scandir('../app/src/components/');
foreach ($availableComponents as $index => $value) {
    if (in_array($value , array('.', '..'))) {
        unset($availableComponents[$index]);
    }
}

$component = ((isset($request->get['component']) and ($request->get['component'] !=='')) ? $request->get['component'] : DEFAULT_COMPONENT);
$action = ((isset($request->get['action']) and ($request->get['action'] !=='')) ? $request->get['action'] : DEFAUTL_ACTION );

if (!in_array($component , $availableComponents)) {
    $component = 'error';
    $action = 'index';
}
$model = null;
//Проверяю существует ли модель и создаю. Внутрь передаю коннектор к бд
$modelFileName = '../app/src/components/' . $component . '/model.php';
if (file_exists($modelFileName)) {
    require_once $modelFileName;
    $modelClassName = $component . 'Model';
    if (class_exists($modelClassName)) {
        $model = new $modelClassName([
            'db' => $db
        ]);
    }
}

$controllerFileName = '../app/src/components/' . $component . '/controller.php';
if (!file_exists($controllerFileName)) {
    die('Error: Could not load controller: ' . $controllerFileName);
}
require_once $controllerFileName;

$ControllerClassName = $component . 'Controller';

if (!class_exists($ControllerClassName)) {
    die('Error: Class not exists: ' . $ControllerClassName);
}

$controller = new $ControllerClassName([
    'model'  => $model,
    'request' => $request
]);

$controller->$action();