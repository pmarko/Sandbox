<?php


namespace Lift\Controller;


use Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return [
            'title' => 'LIFT!'
        ];
    }
}