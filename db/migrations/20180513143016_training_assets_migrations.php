<?php

use Phinx\Migration\AbstractMigration;

class TrainingAssetsMigrations extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('training_assets',['id'=>false, 'primary_key'=>['id']]);
        $table->addColumn('id','uuid')
              ->addColumn('asset_details','text')
              ->addColumn('training_id','uuid')
              ->addColumn('training_asset_type_id','uuid')
              ->addColumn('created','datetime')
              ->addColumn('modified','datetime')
              ->addColumn('deleted','datetime',['null'=>true])
              ->addForeignKey('training_id','trainings','id',['delete'=>'CASCADE','update'=>'CASCADE'])
              ->addForeignKey('training_asset_type_id','training_asset_types','id',['delete'=>'CASCADE','update'=>'CASCADE']);
        $table->create();
    }
}
