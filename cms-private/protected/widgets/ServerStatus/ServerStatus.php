<?php

class ServerStatus extends CWidget
{
    public function init()
    {
        $data = ['content' => [], 'totalOnline' => 0];
        if (($data = cache()->get(CacheNames::SERVER_STATUS)) === false) {
            if (config('server_status.allow') == 1) {
                $data['content'] = [];
                $data['totalOnline'] = 0;

                $criteria = new CDbCriteria([
                    'select' => 't.name, t.id, t.fake_online, t.ip, t.port',
                    'scopes' => ['opened'],
                    'with' => ['ls' => [
                        'select' => 'ls.ip, ls.port, ls.name',
                        'scopes' => ['opened'],
                    ]]
                ]);

                $gsList = Gs::model()->findAll($criteria);

                if ($gsList) {
                    foreach ($gsList as $gs) {
                        $data['content'][$gs->id]['gs'] = $gs;
                        try {
                            $l2 = l2('gs', $gs->id)->connect();

                            // Кол-во игроков
                            $online = $l2->getDb()->createCommand("SELECT COUNT(0) FROM `characters` WHERE `online` = 1")->queryScalar();

                            $data['content'][$gs->id]['gs_status'] = Lineage::getServerStatus($gs->ip, $gs->port);
                            $data['content'][$gs->id]['ls_status'] = (isset($gs->ls) ? Lineage::getServerStatus($gs->ls->ip, $gs->ls->port) : 'offline');
                            $data['content'][$gs->id]['online'] = $online;

                            $data['totalOnline'] += $online;
                        } catch (Exception $e) {
                            Yii::log($e->getMessage(), CLogger::LEVEL_ERROR, 'ServerStatus');
                            $data['content'][$gs->id]['error'] = 'Статус недоступен';
                        }
                    }
                }

                if (config('server_status.cache') > 0) {
                    cache()->set(CacheNames::SERVER_STATUS, $data, config('server_status.cache') * 60);
                }
            }
        }

        app()->controller->renderPartial('//server-status', is_array($data) ? $data : ['content'=>[], 'totalOnline'=>0]);
    }
}
 