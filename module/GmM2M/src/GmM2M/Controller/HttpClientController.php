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
}

class Gmb2CobClient
{
    public function requestDownloadToken(){}

    public function requestUploadToken(){}

    public function downloadFile(){}

    public function uploadFile(){}

    public function downloadVerificationResults(){}
}