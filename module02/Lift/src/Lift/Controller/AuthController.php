<?php


namespace Lift\Controller;


use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Result;
use Zend\Crypt\Password\Bcrypt;
use Zend\Debug\Debug;
use Zend\Mvc\Controller\AbstractActionController;

class MyAuthAdapter implements AdapterInterface{

    private $user;
    private $pass;

    public function __construct($user, $pass)
    {
        $this->user = $user;
        $this->pass = $pass;
    }

    /**
     * Performs an authentication attempt
     *
     * @return \Zend\Authentication\Result
     * @throws \Zend\Authentication\Adapter\Exception\ExceptionInterface If authentication cannot be performed
     */
    public function authenticate()
    {
        if($this->user == 'admin' && $this->pass == 'pass'){
            return new Result(Result::SUCCESS, ['user' => 'admin']);
        }

        return new Result(Result::FAILURE_CREDENTIAL_INVALID, ['user' => 'guest']);
    }
}

class AuthController extends AbstractActionController
{
    public function __construct()
    {
        $this->auth = new AuthenticationService();

    }

    public function loginAction()
    {
        $bCrypt = new Bcrypt(['cost' => 10]);
        echo $hash = $bCrypt->create('password');
        Debug::dump($bCrypt->verify('password', $hash));

        die('aaa');

        $locator = @$this->getServiceLocator();

        $this->auth->setAdapter(new MyAuthAdapter('admin', 'pass'));

        $result = $this->auth->authenticate();

        if($result->isValid()){
            echo "IS VALID";
            return $this->redirect()->toRoute('lift/logout');
        }else{
            echo "IS NOT";
        }

        Debug::dump($this->auth->getIdentity());

        return $this->getResponse();
    }

    public function logoutAction()
    {
        Debug::dump($this->auth->getIdentity());

        $this->auth->clearIdentity();

        return $this->getResponse();
    }
}