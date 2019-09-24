<?php


namespace Lift\Form\Fieldset;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserRegistrationFieldsetFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = $serviceLocator->getServiceLocator()
                ->get('HydratorManager')
                ->get('Lift\Hydrator\DoctrineObject');

        $fieldset = new UserRegistrationFieldset();
        $fieldset->setHydrator($hydrator);
        return $fieldset;
    }
}