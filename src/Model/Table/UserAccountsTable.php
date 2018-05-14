<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use ArrayObject;
use Cake\Utility\Text;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Filesystem\File;
use Cake\Network\Exception;
/**
 * UserAccounts Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\RolesTable|\Cake\ORM\Association\BelongsTo $Roles
 * @property \App\Model\Table\ProjectContributorsTable|\Cake\ORM\Association\HasMany $ProjectContributors
 * @property \App\Model\Table\ProjectsTable|\Cake\ORM\Association\HasMany $Projects
 *
 * @method \App\Model\Entity\UserAccount get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserAccount newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserAccount[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserAccount|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserAccount patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserAccount[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserAccount findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserAccountsTable extends Table
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

        $this->setTable('user_accounts');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ProjectContributors', [
            'foreignKey' => 'user_account_id'
        ]);
        $this->hasMany('Projects', [
            'foreignKey' => 'user_account_id'
        ]);

        $this->hasMany('ProjectAssets', [
            'foreignKey' => 'created_by'
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
            ->scalar('user_account_username')
            ->maxLength('user_account_username', 20)
            ->requirePresence('user_account_username', 'create')
            ->notEmpty('user_account_username')
            ->add('user_account_username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('user_account_password')
            ->requirePresence('user_account_password', 'create')
            ->notEmpty('user_account_password');

        $validator
            ->scalar('user_account_avatar')
            ->requirePresence('user_account_avatar', 'create')
            ->notEmpty('user_account_avatar');

        $validator
            ->boolean('user_account_is_active')
            ->requirePresence('user_account_is_active', 'create')
            ->notEmpty('user_account_is_active');

        $validator
            ->dateTime('deleted')
            ->allowEmpty('deleted');

        $validator
            ->uuid('created_by')
            ->allowEmpty('created_by');

        //custom fields validation
        $validator
            ->add('user_account_avatar_candidate', 'file', [
                'rule' => ['mimeType', ['image/jpeg','image/jpg','image/png','image/bitmap','image/gif']],
                'on' => function($context){

                return (!empty($context['user_account_avatar_candidate'])|| !empty($context['data']['user_account_avatar_candidate']) );
                }
            ])->add('user_account_avatar_candidate', 'fileSize',[
                'rule' => ['fileSize', '<', '3MB'],
                'on' => function($context){
                    return (!empty($context['user_account_avatar_candidate']) || !empty($context['data']['user_account_avatar_candidate']));

                }
            ]);


        return $validator;
    }

   public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options){

        if(isset($data['action'])){
            switch($data['action']){
                case 'create':

                break;

                case 'edit-profile':
                    if(isset($data['profile_accounts'])){
                        $account_credentials = $data['profile_accounts'][0];
                        $hasher = new DefaultPasswordHasher();
                        if($hasher->check($account_credentials['account_password_old'],$data['old_password']))
                            $data['user_account_password'] = $account_credentials['account_password_new'];
                        else
                              throw new Exception\ForbiddenException(__('forbidden'));
                    }
                    
                    // debug($data);
                    // die();
                break;

                case 'edit-admin':
                
                break;
            }
        }
   }

    public function beforeSave($event, $entity, $options){
        if($entity->isNew())
        {
            if(isset($entity->user_account_avatar_candidate))
            {
                //save profile photo
                $target = Text::uuid().'.'.strtolower(pathinfo($entity->user_account_avatar_candidate['name'],PATHINFO_EXTENSION));
                if(move_uploaded_file($entity->user_account_avatar_candidate['tmp_name'], WWW_ROOT.'img/assets/admins/avatar/'.$target))
                {
                    //assign right value to user_account_avatar
                    $entity->user_account_avatar = $target;
                }else
                  return false;
            }

        }else
        {
            if(isset($entity->user_account_avatar_candidate) && $entity->user_account_avatar_candidate!=='null')
            {
                  //replace photo
                $old_path_photo = WWW_ROOT.'img/assets/admins/avatar/'.$entity->user_account_avatar;
                  if(file_exists($old_path_photo))
                       unlink($old_path_photo);
                   $target = Text::uuid().'.'.strtolower(pathinfo($entity->user_account_avatar_candidate['name'],PATHINFO_EXTENSION));
                    if(move_uploaded_file($entity->user_account_avatar_candidate['tmp_name'], WWW_ROOT.'img/assets/admins/avatar/'.$target)){
                        //assign right value to user_account_avatar
                        $entity->user_account_avatar = $target;
                    }else
                      return false;
            }
        }


        // save trail
            // $trail_table = TableRegistry::get('Trails');
            // $trail_action_table = TableRegistry::get('TrailActions');
            // $trail_target_table = TableRegistry::get('TrailTargets');
            // // get action
            // if($entity->is_new)
            //     $search_action = "Création Fiche Sécurité Projet";
            // else
            //     $search_action = "Modification Fiche Sécurité Projet";

            // $action = $trail_action_table->find()->select(['id'])
            //                               ->where(['action_denomination'=>$search_action])
            //                               ->first();
            // // get target
            // $target = $trail_target_table->find()->select(['id'])
            //                               ->where(['target_denomination'=>'Fiche Sécurité Projet'])
            //                               ->first();                

            // $trail = $trail_table->newEntity();
            // $trail->user_account_id = $entity->creator;
            // $trail->trail_action_id = $action->id;
            // $trail->trail_target_id = $target->id;
            // $trail->trail_parent_target = $entity->project_id;

            // if(!($trail->errors())){
            //    if(!($trail_table->save($trail)))
            //     throw new Exception\BadRequestException(__('error bad request save trail'));
            // }else
            //   throw new Exception\BadRequestException(__('error bad request save trail'));
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
        $rules->add($rules->isUnique(['user_account_username']));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));

        return $rules;
    }

    public function findAuth(Query $query, array $options){
         $query->select(['id','user_account_username','user_account_password'])
                ->autoFields(true)
               ->contain(['Roles'])
               ->Where(['user_account_is_active'=>1]);
        return $query;
    }
}
