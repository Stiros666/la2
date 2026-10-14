<?php
$assetsUrl = app()->getThemeManager()->getBaseUrl();
unset(app()->clientScript->scriptMap['jquery.js']);
app()->clientScript->registerCoreScript('jquery');
if ($this->route !== 'index/default/index') css($assetsUrl . '/css/bootstrap.min.css');
js($assetsUrl . '/js/main.js', CClientScript::POS_END);
css('/design/css/style.css');
css('/design/css/cms.css');
if ($this->route === 'index/default/index') { require __DIR__ . '/landing.php'; return; }
?>
<!doctype html><html lang="ru"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="theme-color" content="#080a0d"><title><?php echo e($this->getPageTitle()); ?></title><link rel="icon" href="/design/assets/favicon.png"></head>
<body class="cms-page">
<header class="cms-header"><a href="<?php echo app()->createUrl('/index/default/index'); ?>"><img src="/design/assets/images/logo.png" alt="LA2PLUS"></a><nav aria-label="Навигация"><a href="<?php echo app()->createUrl('/index/default/index'); ?>">Главная</a><a href="<?php echo app()->createUrl('/stats/default/index'); ?>">Статистика</a><a href="<?php echo app()->createUrl('/page/default/index', ['page_name'=>'downloads']); ?>">Скачать игру</a><a href="<?php echo app()->createUrl(user()->isGuest ? '/login/default/index' : '/cabinet/default/index'); ?>">Личный кабинет</a></nav></header>
<?php $this->widget('app.widgets.UserNotifications.UserNotifications'); ?>
<div class="cms-shell"><aside class="cms-sidebar"><p class="cms-eyebrow">LA2PLUS • INTERLUDE</p>
<?php if (!user()->isGuest) { ?><h2>Личный кабинет</h2><p>Баланс: <b><?php echo formatCurrency(user()->get('balance')); ?></b></p><?php $this->widget('zii.widgets.CMenu', [
                            'htmlOptions' => [
                                'class' => 'cabinet-menu',
                            ],
                            'items' => [
                                [
                                    'label' => 'Главная',
                                    'url' => ['/cabinet/default/index']
                                ],
                                [
                                    'label' => 'Пополнить баланс',
                                    'url' => ['/cabinet/deposit/index']
                                ],
                                [
                                    'label' => 'Магазин',
                                    'url' => ['/cabinet/shop/index']
                                ],
                                [
                                    'label' => 'Смена пароля',
                                    'url' => ['/cabinet/changePassword/index']
                                ],
                                [
                                    'label' => 'Безопасность',
                                    'url' => ['/cabinet/security/index']
                                ],
                                [
                                    'label' => 'Персонажи',
                                    'url' => ['/cabinet/characters/index']
                                ],
                                [
                                    'label' => 'Поддержка (' . Tickets::getCountNewMessagesForUser() . ')',
                                    'url' => ['/cabinet/tickets/index']
                                ],
                                [
                                    'label' => 'Реферальная программа',
                                    'url' => ['/cabinet/referals/index'],
                                    'visible' => config('referral_program.allow'),
                                ],
                                [
                                    'label' => 'Мои бонусы',
                                    'url' => ['/cabinet/bonuses/index'],
                                ],
                                [
                                    'label' => 'Ввести бонус код',
                                    'url' => ['/cabinet/bonuses/bonusCode'],
                                ],
                                [
                                    'label' => 'История пополнений',
                                    'url' => ['/cabinet/transactionHistory/index'],
                                    'visible' => config('deposit.allow')
                                ],
                                [
                                    'label' => 'История авторизаций',
                                    'url' => ['/cabinet/authHistory/index'],
                                    'visible' => config('deposit.allow')
                                ],
                                [
                                    'label' => 'Личные сообщения',
                                    'url' => ['/cabinet/messages/index'],
                                ],
                                [
                                    'label' => 'Выход',
                                    'url' => ['/cabinet/default/logout']
                                ],
                            ]
                        ]) ?>
<?php } else { ?><h2>Ваше приключение</h2><nav><a href="<?php echo app()->createUrl('/login/default/index'); ?>">Войти</a><a href="<?php echo app()->createUrl('/register/default/index'); ?>">Создать аккаунт</a><a href="<?php echo app()->createUrl('/forgottenPassword/default/index'); ?>">Восстановить пароль</a></nav><?php } ?>
<div class="cms-status"><?php $this->widget('app.widgets.ServerStatus.ServerStatus'); ?></div></aside>
<main class="cms-content"><?php $this->widget('zii.widgets.CBreadcrumbs',['links'=>$this->breadcrumbs]); ?><?php echo $content; ?></main></div>
<footer class="cms-footer">LA2PLUS · Lineage II · <?php echo date('Y'); ?></footer></body></html>
