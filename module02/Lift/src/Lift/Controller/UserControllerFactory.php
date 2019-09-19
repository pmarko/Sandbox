<?php


namespace Lift\Controller;


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
        $userRegistrationForm = $serviceLocator
            ->getServiceLocator()
            ->get('FormElementManager')
            ->get('Lift\Form\UserRegistrationForm');

        return new UserController($userRegistrationForm);
    }
}