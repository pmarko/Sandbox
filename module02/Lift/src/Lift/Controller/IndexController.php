<?php


namespace Lift\Controller;


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

//        $resources = [];
//        $resources[] = new GenericResource('peter');
//        $resources[] = new GenericResource('reshma');
//        $resources[] = new GenericResource('damian');
//        $resources[] = new GenericResource('victor');
//        $resources[] = new GenericResource('roberto');

//        $resources = ['peter', 'reshma', 'damian', 'victor', 'roberto'];
//
//        $acl = new Acl();
//
//        foreach ($resources as $resource){
//            $acl->addResource($resource);
//        }
//
//        $roles = ['pmmanager', 'tuaitmanager', 'ribitmanager'];
//
//        $acl->addRole('tuaitmanager');
//        $acl->addRole('ribitmanager');
//        $acl->addRole('valeoitmanager', ['tuaitmanager', 'ribitmanager']);
//
//        foreach ($roles as $role){
////            $acl->addRole($role, ['valeoitmanager']);
////        }
//
////        $acl->allow('valeoitmanager', $resources);
//        $acl->allow('tuaitmanager', 'peter', ['payrice', 'fire']);
//        $acl->allow('tuaitmanager', 'roberto', ['paycut', 'fire']);
//        $acl->allow('ribitmanager','victor');
//        $acl->deny('valeoitmanager', 'peter');
//
//        Debug::dump($acl->isAllowed('ribitmanager', 'peter'), 'ribitmanager/peter');
//        Debug::dump($acl->isAllowed('ribitmanager', 'victor'), 'ribitmanager/victor');
//        Debug::dump($acl->isAllowed('tuaitmanager', 'peter'), 'tuaitmanager/peter');
//        Debug::dump($acl->isAllowed('tuaitmanager', 'roberto', 'paycut'), 'tuaitmanager/roberto/payrice');
//        Debug::dump($acl->isAllowed('tuaitmanager', 'damian'), 'tuaitmanager/damain');
//
//        echo "--------------------";
//
//        Debug::dump($acl->isAllowed('valeoitmanager', 'peter'), 'valeoitmanager/peter');
//        Debug::dump($acl->isAllowed('valeoitmanager', 'victor'), 'valeoitmanager/victor');
//        Debug::dump($acl->isAllowed('valeoitmanager', 'peter'), 'valeoitmanager/peter');
//        Debug::dump($acl->isAllowed('valeoitmanager', 'roberto'), 'valeoitmanager/roberto');
//        Debug::dump($acl->isAllowed('valeoitmanager', 'damian'), 'valeoitmanager/damain');

        return [
            'title' => 'LIFT!'
        ];
    }
}