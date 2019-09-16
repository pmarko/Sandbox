<?php
namespace Lift;

use Client\Mvc\EventListener\OperationClientEventListener;
use Zend\Debug\Debug;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, function(MvcEvent $e){
            $routeMatch = $e->getRouteMatch();
            if(strpos($routeMatch->getMatchedRouteName(), 'lift') !== false){
                $e->getViewModel()->setTemplate('layout/lift');
            }
        });
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}


