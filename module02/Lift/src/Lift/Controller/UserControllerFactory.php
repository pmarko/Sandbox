<?php


namespace Lift\Controller;


use Lift\Repository\UserRepository;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserControllerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $repo = $serviceLocator->getServiceLocator()->get(UserRepository::class);

        return new UserController($repo);
    }
}