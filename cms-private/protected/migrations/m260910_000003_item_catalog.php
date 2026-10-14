<?php
class m260910_000003_item_catalog extends CDbMigration
{
    public function up()
    {
        if ($this->dbConnection->schema->getTable('{{all_items}}') === null) {
            $this->createTable('{{all_items}}', [
                'item_id'=>'int unsigned NOT NULL PRIMARY KEY', 'name'=>'varchar(255) NOT NULL',
                'add_name'=>'text', 'description'=>'text', 'icon'=>'varchar(255)', 'crystal_type'=>'tinyint unsigned NOT NULL'
            ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
        }
        $file = fopen(Yii::getPathOfAlias('app.data') . '/ghtweb_all_items.sql', 'rb');
        if (!$file) throw new RuntimeException('Каталог предметов не найден');
        $table = $this->dbConnection->tablePrefix . 'all_items';
        $transaction = $this->dbConnection->beginTransaction();
        while (($line = fgets($file)) !== false) {
            if (strpos($line, 'INSERT INTO `ghtweb_all_items`') === 0) {
                $sql = str_replace('INSERT INTO `ghtweb_all_items`', 'INSERT IGNORE INTO `' . $table . '`', $line);
                $this->dbConnection->createCommand($sql)->execute();
            }
        }
        fclose($file);
        $transaction->commit();
    }
    public function down() { return false; }
}
