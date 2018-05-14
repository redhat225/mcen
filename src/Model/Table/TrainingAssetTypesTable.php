<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TrainingAssetTypes Model
 *
 * @property \App\Model\Table\TrainingAssetsTable|\Cake\ORM\Association\HasMany $TrainingAssets
 *
 * @method \App\Model\Entity\TrainingAssetType get($primaryKey, $options = [])
 * @method \App\Model\Entity\TrainingAssetType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TrainingAssetType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TrainingAssetType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TrainingAssetType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TrainingAssetType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TrainingAssetType findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TrainingAssetTypesTable extends Table
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

        $this->setTable('training_asset_types');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('TrainingAssets', [
            'foreignKey' => 'training_asset_type_id'
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
            ->scalar('type_denomination')
            ->maxLength('type_denomination', 100)
            ->requirePresence('type_denomination', 'create')
            ->notEmpty('type_denomination');

        $validator
            ->dateTime('deleted')
            ->allowEmpty('deleted');

        return $validator;
    }
}
