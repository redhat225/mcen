<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use Cake\Network\Exception;
use \Exception as MainException;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Cake\Utility\Security;
use Cake\Auth\DefaultPasswordHasher;
/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class ProfilesController extends AppController
{
    public function initialize(){
        parent::initialize();   
        $this->loadModel('UserAccounts');
    }

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);   
    }

    public function index(){

    }

    public function edit(){
        if($this->request->is('ajax')){
            if($this->request->is('get')){

            }
            if($this->request->is('post')){
                $data = $this->request->data['profile'];
                $candidate_modify_data = [
                    'user' => [
                    'user_personal_email' => $data['user']['user_personal_email'],
                    'user_pro_email' => $data['user']['user_pro_email'],
                    'user_fullname' => $data['user']['user_fullname'],
                    'user_contact' => $data['user']['user_contact'],
                    'user_job' => $data['user']['user_job'],
                    ],
                    'user_account_username' => $data['user_account_username']
                ];

                if(isset($data['profile_accounts']))
                   $candidate_modify_data['profile_accounts'] = $data['profile_accounts'];
                if(isset($data['user_account_avatar_candidate']))
                   $candidate_modify_data['user_account_avatar_candidate'] = $data['user_account_avatar_candidate'];

                if(count($candidate_modify_data)>0)
                {
                 $candidate_modify_data['action'] = 'edit-profile';
                 $profile = $this->UserAccounts->get($this->request->session()->read('Auth.User.id'),['contain'=>['Users']]);
                 $candidate_modify_data['old_password'] = $profile->user_account_password;
                 $profile = $this->UserAccounts->patchEntity($profile,$candidate_modify_data,['associated'=>['Users']]);
                 $profile->dirty('users', true);
                 
                 if(!$profile->errors()){
                    if($this->UserAccounts->save($profile)){
                        $response = ['message' => 'ok'];
                        $this->RequestHandler->renderAs($this, 'json');
                        $this->set(compact('response'));
                        $this->set('_serialize',['response']);
                    }else
                      throw new Exception\BadRequestException(__('error1'));
                 }else
                   throw new Exception\BadRequestException(__('error'));
                }else
                {
                    $response = ['message' => 'ok'];
                    $this->RequestHandler->renderAs($this, 'json');
                    $this->set(compact('response'));
                    $this->set('_serialize',['response']);
                }


            }
        }
    }

    public function get(){
        if($this->request->is('ajax')){
            if($this->request->is('get')){
                $user = $this->request->session()->read('Auth.User');
                $this->RequestHandler->renderAs($this, 'json');
                $this->set(compact('user'));
                $this->set('_serialize',['user']);
            }
        }
    }

    public function all(){
        if($this->request->is('ajax')){
            if($this->request->is('get')){
                $profile = $this->UserAccounts->get($this->request->session()->read('Auth.User.id'),['contain'=>['Users','Roles']]);
                $this->RequestHandler->renderAs($this, 'json');
                $this->set(compact('profile'));
                $this->set('_serialize',['profile']);
            }
        }
    }


}
