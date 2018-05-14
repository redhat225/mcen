<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RolePrivileges Model
 *
 * @property \App\Model\Table\RolesTable|\Cake\ORM\Association\BelongsTo $Roles
 *
 * @method \App\Model\Entity\RolePrivilege get($primaryKey, $options = [])
 * @method \App\Model\Entity\RolePrivilege newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RolePrivilege[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RolePrivilege|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RolePrivilege patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RolePrivilege[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RolePrivilege findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RolePrivilegesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('role_privileges');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->uuid('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('role_privilege_action')
            ->maxLength('role_privilege_action', 50)
            ->requirePresence('role_privilege_action', 'create')
            ->notEmpty('role_privilege_action');

        $validator
            ->scalar('role_privilege_controller')
            ->maxLength('role_privilege_controller', 50)
            ->requirePresence('role_privilege_controller', 'create')
            ->notEmpty('role_privilege_controller');

        $validator
            ->dateTime('deleted')
            ->allowEmpty('deleted');

        $validator
            ->uuid('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['role_id'], 'Roles'));

        return $rules;
    }
}
