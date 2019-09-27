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
        $client = new Client();

        $request = new Request();

        $request->setUri('');

        $response = $client->send($request);

        // Debug::dump($response->getHeaders());

        return $this->getResponse();
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