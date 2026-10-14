<?php

error_reporting(-1);
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('Referrer-Policy: strict-origin-when-cross-origin');
ini_set('session.cookie_httponly', '1');
ini_set('session.cookie_samesite', 'Lax');
ini_set('session.use_strict_mode', '1');
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
    ini_set('session.cookie_secure', '1');
}

// The web server must load the bundled private-directory access rules.
if (getenv('LA2PLUS_PRIVATE_GUARD') !== '1' && getenv('REDIRECT_LA2PLUS_PRIVATE_GUARD') !== '1') {
    http_response_code(503);
    header('Content-Type: text/plain; charset=UTF-8');
    exit('Не подключены правила защиты CMS. См. INSTALL-PUBLIC-HTML.md.');
}
$rootPath = __DIR__ . '/cms-private';
$protectedPath = $rootPath . '/protected';

// Проверка установлена ли CMS
if (is_dir($protectedPath . '/modules/install') && !is_file($protectedPath . '/config/lock') && strpos($_SERVER['REQUEST_URI'], 'install') === false) {
    header('Location: /install/');
    exit;
}
// ---------------

// Путь к папке с framework
$yii = $rootPath . '/framework/yii.php';

if (!is_file($yii)) {
    die('Неправильно указан путь до папки <b>framework</b>');
}

// Чтобы включить режим разработки добавьте свой IP в массив тот что снизу, к примеру: ['127.0.0.1']
if (getenv('APP_DEBUG') === '1') {
    define('YII_DEBUG', true);

    $config = $protectedPath . '/config/main-dev.php';
} else {
    error_reporting(0);

    define('YII_DEBUG', false);

    $config = $protectedPath . '/config/main.php';
}

// Запись в лог имени файла и номера строки
define('YII_TRACE_LEVEL', 1);

require_once $protectedPath . '/helpers/global.php';

require_once $rootPath . '/vendor/autoload.php';

require_once $yii;

$app = Yii::createWebApplication($config);

CHtml::setModelNameConverter(function($model) {
    $reflector = new ReflectionClass($model);
    return $reflector->getShortName();
});

$app->run();
