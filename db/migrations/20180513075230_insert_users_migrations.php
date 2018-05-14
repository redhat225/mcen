<?php

use Phinx\Migration\AbstractMigration;
use Cake\Utility\Text;

class InsertUsersMigrations extends AbstractMigration
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
    public function up()
    {
        //insert user
        $table = $this->table('users');
        $user_id = Text::uuid();
        $now = new \DateTime();
        $now_formatted = $now->format('Y-m-d H:i:s');

        $user = [
            "id" => $user_id,
            "user_fullname" => "RIEHL Emmanuel",
            "user_sexe" => "H",
            "user_contact" => "87853436",
            "user_personal_email" => "riehlemm@gmail.com",
            "user_pro_email" => "riehlemm@gmail.com",
            "user_photo" => "riehl.png",
            "user_job" => "Ingénieur Sécurité",
            "created" => $now_formatted,
            "modified" => $now_formatted,
        ];


        $table->insert($user);
        $table->saveData();

        //insert role
        $table = $this->table('roles');
        $role_id = Text::uuid();
        $role = [
            [
                "id" => $role_id,
                "role_denomination" => "master",
                "created" => $now_formatted,
                "modified" => $now_formatted,
                "created_by" => $user_id,
            ],
            [
                "id" => Text::uuid(),
                "role_denomination" => "auditor",
                "created" => $now_formatted,
                "modified" => $now_formatted,
                "created_by" => $user_id
            ]

        ];

        $table->insert($role);
        $table->saveData();

        //insert useraccount
        $table = $this->table('user_accounts');

        $user_account = [
            "id" => Text::uuid(),
            "user_account_username" => "remmanuel225",
            "user_account_password" => '$2y$10$fvMsIN8Y9kbPa1MpqT1ogO7NNw6W/eL6nCJBV8WRmKUgEiROs3uXu',
            "user_account_avatar" => "remmanuel.png",
            "user_account_is_active" => true,
            "created_by" => $user_id,
            "created" => $now_formatted,
            "modified" => $now_formatted,
            "user_id" => $user_id,
            "role_id" => $role_id
        ];

        $table->insert($user_account);
        $table->saveData();
    }

    public function down(){
         $this->execute('DELETE FROM users');
         $this->execute('DELETE FROM user_accounts');
         $this->execute('DELETE FROM roles');
    }
}
