<?php


namespace Lift\ServiceManager\Initializer;


use Lift\Auth\AuthServiceAwareInterface;
use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AuthServiceAwareInitializer implements InitializerInterface
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
        if($instance instanceof AuthServiceAwareInterface){
            $instance->setAuthService($serviceLocator->get(AuthenticationService::class));
        }
    }
}