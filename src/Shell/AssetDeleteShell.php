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

class AssetDeleteShell extends Shell
{

  public function main()
  {
    $this->listen();
  }

  public function listen(){
      $client = new Pheanstalk('127.0.0.1');
      $client->watch('AssetDeleteTube');

    while($job = $client->reserve()){
      $payload =json_decode($job->getData(),true);

          $status = $this->deleteAsset($payload);
          if($status)
          {
            $client->delete($job);
            $this->out('Sent asset delete');
          }
          else
          {
            $client->bury($job);
            $this->out('Released asset delete');
          }
    }
  }

  public function deleteAsset($payload){
                                        try{
                                            $upload = true;
                                                  //unlink data
                                                  if(!(unlink(WWW_ROOT.'img/tmp_evidence/'.$payload['image']))){
                                                      $upload = false;
                                                  }
                                        }catch(MainException $e){
                                            $upload = false;
                                        }
                                        return $upload;
  }



}