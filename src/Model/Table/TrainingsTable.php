<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use ArrayObject;
use Cake\Utility\Text;

/**
 * Trainings Model
 *
 * @property \App\Model\Table\TrainingAssetsTable|\Cake\ORM\Association\HasMany $TrainingAssets
 *
 * @method \App\Model\Entity\Training get($primaryKey, $options = [])
 * @method \App\Model\Entity\Training newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Training[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Training|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Training patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Training[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Training findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TrainingsTable extends Table
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

        $this->setTable('trainings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('TrainingAssets', [
            'foreignKey' => 'training_id'
        ]);
    }


   public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options){
        if(isset($data['action'])){
            switch($data['action']){
                case 'create':
                    $data['training_denomination'] =strtoupper($data['training_denomination']);
                break;

                case 'edit-admin':
                    
                break;
            }
        }
   }



    public function beforeSave($event, $entity, $options){

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
            ->scalar('training_denomination')
            ->maxLength('training_denomination', 100)
            ->requirePresence('training_denomination', 'create')
            ->notEmpty('training_denomination');

        $validator
            ->scalar('training_details')
            ->allowEmpty('training_details');

        $validator
            ->dateTime('deleted')
            ->allowEmpty('deleted');

        return $validator;
    }
}
