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
use Cake\View\View;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Filesystem\Folder;
/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class AccountsController extends AppController
{
    public function initialize(){
        parent::initialize();   
        $this->loadModel('UserAccounts');
        $this->loadModel('Users');
    }

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);   
    }

    public function index(){
        
    }

    public function view(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){

            }
        }
    }

    public function all(){

    }

    public function create(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                
            }
        }
    }


    public function edit(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                $data = $this->request->data['profile'];
                $data['user_accounts'][0]['user_account_is_active'] = $data['user_accounts'][0]['user_account_is_active'] === 'true'? true:false;

                if($data['deleted'] === 'null')
                    $data['deleted'] = null;

                if($data['user_accounts'][0]['deleted'] ==='null')
                    $data['user_accounts'][0]['deleted'] = null;

                $user = $this->Users->get($data['id'],['contain'=>['UserAccounts']]);
                $data['action'] = 'edit-admin';
                $data['user_accounts'][0]['action'] = 'edit-admin';
                $user = $this->Users->patchEntity($user,$data,['associated'=>['UserAccounts']]);
                if(!$user->errors()){
                    if($this->Users->save($user)){
                        $response = ['message' => 'ok'];
                        $this->RequestHandler->renderAs($this, 'json');
                        $this->set(compact('response'));
                        $this->set('_serialize',['response']); 
                    }else
                      throw new Exception\BadRequestException(__('error1'));
                }else
                 throw new Exception\BadRequestException(__('error'));
            }
        }
    }

    public function get(){
        if($this->request->is('ajax')){
            if($this->request->is('get')){
                $data = $this->request->query;
                $user = $this->Users->get($data['id'],['contain'=>['UserAccounts']]);
                if(count($user)>0){
                    $this->RequestHandler->renderAs($this, 'json');
                    $this->set(compact('user'));
                    $this->set('_serialize',['user']); 
                }else
                   throw new Exception\BadRequestException(__('error'));
            }
        }
    }

    public function unlock(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                $data = $this->request->data;
                $user_account = $this->UserAccounts->get($data['id']);

                if($user_account->user_account_is_active == false)
                    $user_account->user_account_is_active = true;
                else
                    $user_account->user_account_is_active = false;

                if($this->UserAccounts->save($user_account)){
                    $response = ['message' => 'ok'];
                    $this->RequestHandler->renderAs($this, 'json');
                    $this->set(compact('response'));
                    $this->set('_serialize',['response']); 
                }else
                   throw new Exception\BadRequestException(__('error'));
            }
        }
    }

    public function renew(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                $data = $this->request->data;
                $user_account = $this->UserAccounts->get($data['id']);
                $user_account->user_account_password = 'orange@2018';
                if($this->UserAccounts->save($user_account)){
                    $response = ['message' => 'ok'];
                    $this->RequestHandler->renderAs($this, 'json');
                    $this->set(compact('response'));
                    $this->set('_serialize',['response']); 
                }else
                   throw new Exception\BadRequestException(__('error'));
            }
        }
    }
    


}
