<?php
require __DIR__.'/bootstrap.php';
$runner = new CConsoleCommandRunner();
$runner->addCommands(Yii::getPathOfAlias('app.commands'));
exit($runner->run(['yiic','mymigrate','--interactive=0']));
