<?php

class DefaultController extends CController
{
    public $layout = '/layouts/master';

    protected function beforeAction($action)
    {
        $file = Yii::getPathOfAlias('app') . '/config/lock';
        if (file_exists($file)) {
            return $this->redirect(['/index/default/index']);
        }
        app()->getErrorHandler()->errorAction = 'install/default/error';
        if ($action->id === 'error') return parent::beforeAction($action);
        // The installer starts in the browser. Later steps belong to the
        // session that successfully supplied credentials for an empty DB.
        if (in_array($action->id, ['step3', 'step4', 'step5'], true)
            && !app()->session->get('installer_database_ready', false)) {
            $this->redirect(['step2']);
            return false;
        }
        app()->getErrorHandler()->errorAction = 'install/default/error';
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionStep2()
    {
        $model = new Step2Form();

        if (isset($_POST['Step2Form'])) {
            $model->attributes = $_POST['Step2Form'];

            if ($model->validate()) {
                $dbConfig = [
                    'connectionString' => 'mysql:host=' . $model->mysql_host . ';port=' . (int)$model->mysql_port . ';dbname=' . $model->mysql_name,
                    'emulatePrepare' => true,
                    'username' => $model->mysql_user,
                    'password' => $model->mysql_pass,
                    'charset' => 'utf8',
                    'tablePrefix' => 'ghtweb_',
                    'enableProfiling' => false,
                    'enableParamLogging' => false,
                    'schemaCachingDuration' => 3600,
                ];
                $body = "<?php\nreturn " . var_export($dbConfig, true) . ";\n";
                if (file_put_contents(Yii::getPathOfAlias('app.config') . '/database.php', $body, LOCK_EX) === false) {
                    throw new CHttpException(500, 'Не удалось сохранить конфигурацию БД.');
                }

                app()->session['installer_database_ready'] = true;

                $this->redirect(['step3']);
            }
        }

        $this->render('step2', [
            'model' => $model,
        ]);
    }

    /**
     * Установка миграций
     */
    public function actionStep3()
    {
        $res = '';

        try {
            $res = $this->runMigrationTool();
        } catch (Exception $e) {
            Yii::log($e->getMessage(), CLogger::LEVEL_ERROR, 'Install::step3');
        }

        $this->render('step3', [
            'res' => $res,
        ]);
    }

    private function runMigrationTool()
    {
        $commandPath = Yii::app()->getBasePath() . DIRECTORY_SEPARATOR . 'commands';
        $runner = new CConsoleCommandRunner();
        $runner->addCommands($commandPath);
        $args = ['yiic', 'mymigrate', '--interactive=0'];
        ob_start();
        $runner->run($args);

        return htmlentities(ob_get_clean(), null, Yii::app()->charset);
    }

    /**
     * Создание админа
     */
    public function actionStep4()
    {
        $model = new Step4Form(new \app\services\YiiPasswordManager());

        if (isset($_POST['Step4Form'])) {
            $model->setAttributes($_POST['Step4Form']);
            if ($model->createAdmin()) {
                $this->finishInstallation();
                return;
            }
        }

        $this->render('step4', [
            'model' => $model,
        ]);
    }

    /**
     * Finish
     */
    public function actionStep5()
    {
        $this->redirect(['step4']);
    }

    private function finishInstallation()
    {
        if (file_put_contents(Yii::getPathOfAlias('app.config') . '/lock', '', LOCK_EX) === false) {
            throw new CHttpException(500, 'Не удалось закрыть установщик. Проверьте права записи на каталог конфигурации.');
        }
        app()->session->remove('installer_database_ready');
        app()->session->remove('installer_authorized');
        foreach (['install-key.php','setup-url.txt'] as $name) {
            $path = Yii::getPathOfAlias('app.config') . '/' . $name;
            if (is_file($path)) unlink($path);
        }
        $this->render('step5');
    }

    public function actionError()
    {
        if ($error = app()->errorHandler->error) {
            $this->render('error', $error);
        }
    }
}

