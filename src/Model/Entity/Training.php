<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Training Entity
 *
 * @property string $id
 * @property string $training_denomination
 * @property string $training_details
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 *
 * @property \App\Model\Entity\TrainingAsset[] $training_assets
 */
class Training extends Entity
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
        'training_denomination' => true,
        'training_details' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'training_assets' => true
    ];
}
