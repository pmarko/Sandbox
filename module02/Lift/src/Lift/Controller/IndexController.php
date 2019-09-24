<?php


namespace Lift\Controller;


use Lift\Form\UserLoginForm;
use Lift\Model\UserDelegator;
use Lift\Model\UserModel;
use Lift\Model\UserRegistrationModel;
use Lift\Repository\FoundAtOptionsRepo;
use phpDocumentor\Reflection\DocBlock\Tags\Generic;
use Zend\Debug\Debug;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Resource\GenericResource;
use Zend\Permissions\Acl\Role\GenericRole;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return [
            'title' => 'LIFT!'
        ];
    }
}