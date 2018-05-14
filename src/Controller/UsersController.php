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
use Cake\Cache\Cache;
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
class UsersController extends AppController
{
    public function initialize(){
        parent::initialize();   
    }

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);   
    }

    public function all(){
        if($this->request->is('ajax')){
            if($this->request->is('get')){
                $users = $this->Users->find()->contain(['UserAccounts.Roles']);
                if(count($users)>0)
                {
                    $this->RequestHandler->renderAs($this, 'json');
                    $this->set(compact('users'));
                    $this->set('_serialize',['users']);
                }else
                    throw new Exception\BadRequestException(__('error'));
            }
        }
    }

    public function create(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                $data = $this->request->data['user'];
                $data['action'] = 'create';
                $data['creator'] = $this->request->session()->read('Auth.User.id');
                $user = $this->Users->newEntity($data,['associated'=>['UserAccounts']]);
                if($this->Users->save($user)){
                    $response = ['message'=>'ok'];
                    $this->RequestHandler->renderAs($this, 'json');
                    $this->set(compact('response'));
                    $this->set('_serialize',['response']);
                }else{
                  throw new Exception\BadRequestException(__('error'));
                }
            }
        }
    }

}
