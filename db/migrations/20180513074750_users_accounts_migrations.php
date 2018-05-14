<?php

use Phinx\Migration\AbstractMigration;

class UsersAccountsMigrations extends AbstractMigration
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
        $table = $this->table('user_accounts',['id'=>false, 'primary_key' => ['id']]);
        $table->addColumn('id','uuid')
              ->addColumn('user_account_username','string',['limit'=>20])
              ->addColumn('user_account_password','text')
              ->addColumn('user_account_avatar','text')
              ->addColumn('user_account_is_active','boolean')
              ->addColumn('created','datetime')
              ->addColumn('modified','datetime')
              ->addColumn('deleted','datetime',['null'=>true])
              ->addColumn('created_by','uuid',['null'=>true])
              ->addColumn('user_id','uuid')
              ->addColumn('role_id','uuid')
              ->addForeignKey('user_id','users','id',['delete'=>'CASCADE','update'=>'CASCADE']);
        $table->create();
    }
}
