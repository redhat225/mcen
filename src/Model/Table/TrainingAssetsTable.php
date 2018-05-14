<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use Cake\Utility\Text;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Filesystem\File;
use Cake\Network\Exception;

use ArrayObject;
/**
 * TrainingAssets Model
 *
 * @property \App\Model\Table\TrainingsTable|\Cake\ORM\Association\BelongsTo $Trainings
 * @property \App\Model\Table\TrainingAssetTypesTable|\Cake\ORM\Association\BelongsTo $TrainingAssetTypes
 *
 * @method \App\Model\Entity\TrainingAsset get($primaryKey, $options = [])
 * @method \App\Model\Entity\TrainingAsset newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TrainingAsset[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TrainingAsset|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TrainingAsset patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TrainingAsset[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TrainingAsset findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TrainingAssetsTable extends Table
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

        $this->setTable('training_assets');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Trainings', [
            'foreignKey' => 'training_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('TrainingAssetTypes', [
            'foreignKey' => 'training_asset_type_id',
            'joinType' => 'INNER'
        ]);
    }

   public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options){
        if(isset($data['action'])){
            switch($data['action']){
                case 'add-assets':

                break;
            }
        }
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
            ->scalar('asset_details')
            ->requirePresence('asset_details', 'create')
            ->notEmpty('asset_details');

        $validator
            ->dateTime('deleted')
            ->allowEmpty('deleted');

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
        $rules->add($rules->existsIn(['training_id'], 'Trainings'));
        $rules->add($rules->existsIn(['training_asset_type_id'], 'TrainingAssetTypes'));

        return $rules;
    }
}
