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
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setVariable('title', 'LIFT!');

        $currentDemandsViewModel = $this->forward()->dispatch('Lift\Controller\Demand', [
            'action' => 'renderTable',
            'size' => 10
        ]);

        $currentOffersViewModel = $this->forward()->dispatch('Lift\Controller\Offer', [
            'action' => 'renderTable',
            'size' => 10
        ]);

        $viewModel->addChild($currentDemandsViewModel, 'current_requests');
        $viewModel->addChild($currentOffersViewModel, 'current_offers');

        return $viewModel;
    }
}