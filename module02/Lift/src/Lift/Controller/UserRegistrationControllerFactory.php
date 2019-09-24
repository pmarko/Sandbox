<?php


namespace Lift\Controller;


use Lift\Form\UserRegistrationForm;
use Lift\Repository\UserRegistrationRepository;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserRegistrationControllerFactory implements FactoryInterface
{
    /**
     * Create service
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = $serviceLocator
            ->getServiceLocator()
            ->get('FormElementManager')
            ->get(UserRegistrationForm::class);

        $repo = $serviceLocator->getServiceLocator()->get(UserRegistrationRepository::class);

        return new UserRegistrationController($form, $repo);
    }
}