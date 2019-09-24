<?php


namespace Lift\ServiceManager\Initializer;


use Lift\Auth\AuthServiceAwareInterface;
use Lift\ObjectManager\ObjectManagerAwareInterface;
use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ObjectManagerAwareInitializer implements InitializerInterface
{
    /**
     * Initialize
     *
     * @param $instance
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function initialize($instance, ServiceLocatorInterface $serviceLocator)
    {
        if($instance instanceof ObjectManagerAwareInterface){
            $objectManager = $serviceLocator->get('doctrine.entitymanager.orm_default');
            $instance->setObjectManager($objectManager);
        }
    }
}