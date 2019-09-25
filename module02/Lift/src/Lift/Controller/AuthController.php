<?php


namespace Lift\Controller;


use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Authentication\Result;
use Zend\Crypt\Password\Bcrypt;
use Zend\Debug\Debug;
use Zend\Form\FormInterface;
use Zend\Hydrator\ClassMethods;
use Zend\Hydrator\NamingStrategy\MapNamingStrategy;
use Zend\Mvc\Controller\AbstractActionController;

class AuthController extends AbstractActionController
{
    /**
     * @var AuthenticationServiceInterface
     */
    private $authService;

    /**
     * @var FormInterface
     */
    private $loginForm;

    /**
     * AuthController constructor.
     * @param AuthenticationServiceInterface $authService
     */
    public function __construct(AuthenticationServiceInterface $authService, FormInterface $loginForm)
    {
        $this->authService = $authService;
        $this->loginForm = $loginForm;
    }

    public function loginAction()
    {
        //TODO: move this to better location
        $this->loginForm->get('user_login')
        ->getHydrator()
        ->setNamingStrategy(new MapNamingStrategy([
            'user_name' => 'identity',
            'password' => 'credential'
        ]));

        if(!$this->getRequest()->isPost()){
            return $this->notFoundAction();
        }

        $adapter = $this->authService->getAdapter();

        $this->loginForm->bind($adapter);

        $this->loginForm->setData($this->params()->fromPost());

        if(!$this->loginForm->isValid()){
            return $this->notFoundAction();
        }

        $result = $this->authService->authenticate();

        //TODO: FLASH-MESSENGER!!!!!!!!

        if($result->isValid()){
          return $this->redirect()->toRoute('lift');
        }else{
          return $this->redirect()->toRoute('lift');
        }
    }

    public function logoutAction()
    {
        $this->authService->clearIdentity();

        return $this->redirect()->toRoute('lift');
    }
}