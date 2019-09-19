<?php


namespace Lift\View\Helper;


use Lift\Form\UserLoginForm;
use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AuthElementFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $locator = $serviceLocator->getServiceLocator();

        $authService =$locator->get(AuthenticationService::class);
        $loginForm = $locator->get('FormElementManager')->get(UserLoginForm::class);
        return new AuthElement($authService, $loginForm);
    }
}