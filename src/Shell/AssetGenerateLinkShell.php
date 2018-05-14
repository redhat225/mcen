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

class AssetGenerateLinkShell extends Shell
{

  public function main()
  {
    $this->listen();
  }

  public function listen(){
      $client = new Pheanstalk('127.0.0.1');
      $client->watch('GenerateSharedLinkUploadTube');

    while($job = $client->reserve()){
      $payload =json_decode($job->getData(),true);

          $status = $this->generateSharedLink($payload);
          if($status)
          {
            $client->delete($job);
            $this->out('Sent generate Link delete');
          }
          else
          {
            $client->bury($job);
            $this->out('Released generate Link delete');
          }
    }
  }

  public function generateSharedLink($payload){
                                                  // //unlink data
                                                  // if(!(unlink(WWW_ROOT.'img/tmp_evidence/'.$payload['image']))){
                                                  //     $this->out('Job upload error 2');
                                                  //     $upload = false;
                                                  // }
                                        try{
                                          $upload = true;
                                                  $shared_link_data = [
                                                              'path' => $payload['response']['path_lower'],
                                                              'settings' => [
                                                                  'requested_visibility' => "public"
                                                              ]
                                                          ];

                                                          $client_2 = new Client([
                                                              'headers' => [
                                                                  'Content-Type' => "application/json",
                                                                  'Authorization' => 'Bearer '.Configure::read('dropbox-api.token'),
                                                              ]
                                                          ]);

                                                          $response_2 = $client_2->post('https://api.dropboxapi.com/2/sharing/create_shared_link_with_settings', json_encode($shared_link_data),['type'=>'json']);
                                                          $response_2_data = $response_2->json;

                                                          if(isset($response_2_data['error'])){
                                                              $upload = false;
                                                          }else{
                                                              $link = $response_2_data['url'];
                                                              $pattern = "/dl=0/";
                                                              $link_main_photo_candidate = preg_replace($pattern, "dl=1", $link);

                                                              $this->loadModel('TrainingAssets');
                                                              $indexed_entity = $this->TrainingAssets->get($payload['id']);
                                                              $asset_details_content = json_decode($indexed_entity->asset_details);
                                                              $asset_details_content->remote_path = $link_main_photo_candidate;

                                                               // composing payload
                                                                        $save_upload_payload = [
                                                                          'image' => $payload['image'],
                                                                          'id' => $payload['id'],
                                                                          'payload' => json_encode($asset_details_content)
                                                                        ];
                                                              $pheanstalk_save = new Pheanstalk('127.0.0.1');
                                                              $pheanstalk_save->useTube('AssetSaveUploadTube');
                                                              $pheanstalk_save->put(json_encode($save_upload_payload));

                                                          }

                                        }catch(MainException $e){
                                            $upload = false;
                                        }
                                        return $upload;

  }



}