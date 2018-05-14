<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RolePrivilege Entity
 *
 * @property string $id
 * @property string $role_privilege_action
 * @property string $role_privilege_controller
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 * @property string $created_by
 * @property string $role_id
 *
 * @property \App\Model\Entity\Role $role
 */
class RolePrivilege extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'role_privilege_action' => true,
        'role_privilege_controller' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'created_by' => true,
        'role_id' => true,
        'role' => true
    ];
}
