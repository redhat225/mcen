<?php

use Phinx\Migration\AbstractMigration;
use Cake\Utility\Text;

class InsertTrainingAssetTypesMigrations extends AbstractMigration
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
    public function up(){
        $table = $this->table('training_asset_types');
        $now = new \DateTime();
        $now_formatted = $now->format('Y-m-d H:i:s');

        $types = [
            [
                'id' => Text::uuid(),
                'created' => $now_formatted,
                'modified' => $now_formatted,
                'deleted' => NULL,
                'type_denomination' => 'Outil',
            ],
            [
                'id' => Text::uuid(),
                'created' => $now_formatted,
                'modified' => $now_formatted,
                'deleted' => NULL,
                'type_denomination' => 'Cours',
            ],
            [
                'id' => Text::uuid(),
                'created' => $now_formatted,
                'modified' => $now_formatted,
                'deleted' => NULL,
                'type_denomination' => 'Autre',
            ]
        ];

        $table->insert($types);
        $table->saveData();
    }

    public function down(){
         $this->execute('DELETE FROM training_asset_types');
    }
}
