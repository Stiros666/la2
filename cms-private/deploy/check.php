<?php
if (PHP_SAPI !== 'cli') exit(1);
$failed = false;
function checkResult($label, $ok) { global $failed; echo ($ok ? '[OK] ' : '[FAIL] ') . $label . PHP_EOL; if (!$ok) $failed = true; }
checkResult('PHP 8.3+', version_compare(PHP_VERSION, '8.3.0', '>='));
foreach (['pdo_mysql','mbstring','gd','openssl','curl','fileinfo','json','dom'] as $ext) checkResult('extension: '.$ext, extension_loaded($ext));
$root = dirname(__DIR__);
foreach (['protected/runtime','../assets','../uploads'] as $dir) checkResult('writable: '.$dir, is_writable($root.'/'.$dir));
checkResult('Composer dependencies', is_file($root.'/vendor/autoload.php'));
checkResult('LA2PLUS theme', is_file($root.'/themes/la2plus/views/layouts/master.php'));
echo 'DocumentRoot must point to: '.dirname($root).PHP_EOL;
exit($failed ? 1 : 0);
