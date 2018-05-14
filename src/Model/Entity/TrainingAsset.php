<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TrainingAsset Entity
 *
 * @property string $id
 * @property string $asset_details
 * @property string $training_id
 * @property string $training_asset_type_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 *
 * @property \App\Model\Entity\Training $training
 * @property \App\Model\Entity\TrainingAssetType $training_asset_type
 */
class TrainingAsset extends Entity
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
        'asset_details' => true,
        'training_id' => true,
        'training_asset_type_id' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'training' => true,
        'training_asset_type' => true
    ];
}
