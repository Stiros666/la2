<?php
class m260910_000001_la2plus_theme extends CDbMigration {
 public function safeUp() { foreach (['meta.title'=>'LA2PLUS — Lineage 2', 'meta.description'=>'LA2PLUS Interlude', 'index.type'=>'news', 'news.detail.socials'=>'0'] as $key=>$value) { $this->update('{{config}}', ['value'=>$value], 'param=:p', [':p'=>$key]); } $this->update('{{config}}', ['value'=>'la2plus','default'=>'la2plus'], 'param=:p', [':p'=>'theme']); }
 public function safeDown() { $this->update('{{config}}', ['value'=>'ghtweb','default'=>'ghtweb'], 'param=:p', [':p'=>'theme']); }
}
