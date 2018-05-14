<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TrainingAssetType Entity
 *
 * @property string $id
 * @property string $type_denomination
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 *
 * @property \App\Model\Entity\TrainingAsset[] $training_assets
 */
class TrainingAssetType extends Entity
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
        'type_denomination' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'training_assets' => true
    ];
}
