<?php


namespace GmM2M\Controller;


use Zend\Debug\Debug;
use Zend\Http\Client;
use Zend\Http\Request;
use Zend\Mvc\Controller\AbstractActionController;

class HttpClientController extends AbstractActionController
{
    public function indexAction()
    {
//        $client = new Client();
//
//        $request = new Request();
//
//        $request->setUri('https://gmb2cob.gm.com/downloadtuples/v1/');
//
//        $response = $client->send($request);


        $vars = ['a' => 'b'];
        $opts = [
            'name' => 'peter'
        ];

        $queue = new \ZendJobQueue();
        $jobID = $queue->createHttpJob("http://localhost/sandbox/public/gmm2m/execute", $vars, $opts);
        echo $jobID;

        return $this->getResponse();
    }

    public function executeAction()
    {
        // create executions record in db

        // some code here

        // ok
        // update success

        // error
        // update error + message


        return $this->getResponse()->setContent('Hello');
    }

    // server/gmm2m/download/check-levels
    public function orderDownloadAction()
    {
        $configs = [1,2,3,4,5];

        $limit = 3;

        foreach ($configs as $config){
            if($config < $limit){

                echo "create download order in db";

                echo "creating b with order id"

                $queue = new \ZendJobQueue();
                $job = $queue->createHttpJob('server/gmm2m/download/execute/1234}', [],[])
            }
        }

        // find all configs
        // for each
        // check the level
        // if level low
        // download
        // if download fails wait 10 minutes
        // download
    }

    // server/gmm2m/download/execute
    public function downloadAction()
    {
        $orderID = $this->params()->fromQuery('order');


        echo "READING ORDER FROM DB";
        echo "CREATING RECORD IN DB";
        // check if order has gmrequestid
        // if not
        // get getrequestgmid
        // save it to the order
        // else
        // just dowload the file with gmrequestid
        echo "DOWNLOADING FILE";
        echo "UPDATTING REC IN DB WITH STATUS";
    }


}

class Gmb2CobClient
{
    public function requestDownloadToken(){}

    public function requestUploadToken(){}

    public function downloadFile(){}

    public function uploadFile(){}

    public function downloadVerificationResults(){}
}