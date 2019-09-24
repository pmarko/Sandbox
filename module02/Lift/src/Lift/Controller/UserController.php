<?php


namespace Lift\Controller;


use Lift\Repository\UserRegistrationRepository;
use Lift\Repository\UserRepository;
use Zend\Debug\Debug;
use Zend\Form\FormInterface;
use Zend\Hydrator\ClassMethods;
use Zend\Hydrator\NamingStrategy\MapNamingStrategy;
use Zend\Mvc\Controller\AbstractActionController;


use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController
{

    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
}