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
use Cake\Utility\Text;
use Pheanstalk\Pheanstalk;
/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class TrainingAssetsController extends AppController
{
    public function initialize(){
        parent::initialize();   
        $this->loadModel('ProjectSecuritySheets');
    }

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);   
    }

    public function index(){
        
    }
    public function add(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                $data = $this->request->data;
                $files =[];
               foreach ($data['assets'] as $key => $value){
                    if(($value['error']!=0) || ($value['size']>1000000000))
                      unset($data['assets'][$key]);
                  else{
                    // upload asset previously
                    $evidence_path = Text::uuid().".".strtolower(pathinfo($value['name'],PATHINFO_EXTENSION));
                    $value['random_name'] = $evidence_path;

                    if(!move_uploaded_file($value['tmp_name'], WWW_ROOT.'img/tmp_evidence/'.$evidence_path))
                      unset($data['assets'][$key]);
                    else{
                        $file = [
                            'training_id' => $data['training_id'],
                            'training_asset_type_id' => $data['asset_types'][$key],
                            'asset_details' => json_encode($value),
                        ];
                        array_push($files, $file);
                    }

                  }
                }
                $data['action'] = "add-assets";
                $training_assets = $this->TrainingAssets->newEntities($files);

                if($this->TrainingAssets->saveMany($training_assets)){
                    foreach ($training_assets as $training_asset){
                        $decoded_training_asset_details = json_decode($training_asset->asset_details);
                        $payload = [
                                    'id'=> $training_asset->id,
                                    'image' => $decoded_training_asset_details->random_name
                        ];
                            // open a pipe here
                            $pheanstalk = new Pheanstalk('127.0.0.1');
                            $pheanstalk->useTube('AssetUploadTube');
                            $pheanstalk->put(json_encode($payload)); 
                    }

                    $response = ['message' => 'ok'];
                    $this->RequestHandler->renderAs($this,'json');
                    $this->set(compact('response'));
                    $this->set('_serialize',['response']);
                }else
                   throw new Exception\BadRequestException(__('error saved'));

            }
        }
    }

}
