<?php 
namespace App\Shell;

use Cake\Console\Shell;
use Cake\Core\Configure;
use Cake\Mailer\Email;
use Pheanstalk\Pheanstalk;
use \Exception as MainException;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Http\Client;
use Cake\Utility\Text;

class AssetSaveUploadShell extends Shell
{

  public function main()
  {
    $this->listen();
  }

  public function listen(){
      $client = new Pheanstalk('127.0.0.1');
      $client->watch('AssetSaveUploadTube');

    while($job = $client->reserve()){
      $payload =json_decode($job->getData(),true);

          $status = $this->save($payload);
          if($status)
          {
            $client->delete($job);
            $this->out('Save Upload Job Delete');
          }
          else
          {
            $client->bury($job);
            $this->out('Save Upload Job Released');
          }
    }
  }

  public function save($payload){
          $save = true;
          $this->loadModel('TrainingAssets');
          $indexed_entity = $this->TrainingAssets->get($payload['id']);
          $indexed_entity->asset_details = $payload['payload'];
          try{
            $this->TrainingAssets->save($indexed_entity);

                                                               // composing payload
                                                                        $save_upload_payload = [
                                                                          'image' => $payload['image'],
                                                                          'id' => $payload['id'],
                                                                        ];
                                                              $pheanstalk_save = new Pheanstalk('127.0.0.1');
                                                              $pheanstalk_save->useTube('AssetDeleteTube');
                                                              $pheanstalk_save->put(json_encode($save_upload_payload));
          }catch(MainException $e){
            $save = false;
          }
          return $save;
  }



}