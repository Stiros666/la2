<?php
require __DIR__.'/bootstrap.php';
$id = filter_var($argv[1] ?? null, FILTER_VALIDATE_INT);
if (!$id || $id < 1) { fwrite(STDERR,"Usage: php deploy/check-lucera.php GAME_SERVER_ID\n"); exit(1); }
$gs = Gs::model()->findByPk($id);
if (!$gs) { fwrite(STDERR,"Game server not found. Configure it in the admin panel first.\n"); exit(1); }
$failed = false;
foreach (['accounts'=>['ls',(int)$gs->login_id], 'characters'=>['gs',$id], 'clans'=>['gs',$id], 'items'=>['gs',$id]] as $query=>$target) {
    try { l2($target[0],$target[1])->connect()->$query()->limit(0)->queryAll(); echo '[OK] '.$query.PHP_EOL; }
    catch (Throwable $e) { echo '[FAIL] '.$query.': schema/connection mismatch; see protected/runtime/application.log'.PHP_EOL; Yii::log($e->getMessage(),CLogger::LEVEL_ERROR,'LuceraPreflight'); $failed=true; }
}
echo "Read-only SQL checks. Password format and in-game delivery require a test account on your actual server.\n";
exit($failed ? 1 : 0);
