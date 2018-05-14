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

class AssetUploadShell extends Shell
{

  public function main(){
    $this->listen();
  }

  public function listen(){
    $client = new Pheanstalk('127.0.0.1');
    $client->watch('AssetUploadTube');

    while($job = $client->reserve()){
      $payload =json_decode($job->getData(),true);

          $status = $this->upload($payload);
          if($status)
          {
            $client->delete($job);
            $this->out('Job upload Delete');
          }
          else
          {
            $client->bury($job);
            $this->out('Job upload Released');
          }
    }
  }


  public function upload($payload){
                                     try{
                                            $upload = true;
                                              $main_image_candidate_path = "/trainings/assets"."/".$payload['image'];
                                              $args_api = ['path'=>$main_image_candidate_path, 'mode'=>'add', 'autorename'=>true,'mute'=>false];
                                              $client = new Client([
                                                  'headers' => [
                                                      'Content-Type' => "application/octet-stream",
                                                      'Authorization' => "Bearer ".Configure::read('dropbox-api.token'),
                                                      'Dropbox-API-Arg' => json_encode($args_api),
                                                  ]
                                              ]);
                                              $file = new File(WWW_ROOT.'img/tmp_evidence/'.$payload['image']);
                                              $response = $client->post('https://content.dropboxapi.com/2/files/upload',$file->read());
                                              $response_data = $response->json;

                                              if(isset($response_data['error']))
                                                $upload = false;
                                              else{
                                                     // composing payload
                                                              $save_upload_payload = [
                                                                'image' => $payload['image'],
                                                                'id' => $payload['id'],
                                                                'response' => $response_data
                                                              ];

                                                  $pheanstalk_save = new Pheanstalk('127.0.0.1');
                                                  // $pheanstalk_save->kick();
                                                  $pheanstalk_save->useTube('GenerateSharedLinkUploadTube');
                                                  $pheanstalk_save->put(json_encode($save_upload_payload));
                                                }

                                        }catch(MainException $e){
                                            $upload = false;
                                        }

                                 return $upload;
    }


}