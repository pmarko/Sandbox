<?php


namespace Lift\Form\Fieldset;


use Lift\Entity\UserEntity;
use Zend\Crypt\Password\Bcrypt;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserFieldsetFactory implements FactoryInterface
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

        $crypto = $serviceLocator->getServiceLocator()
                ->get('Lift\Crypto\Crypto');

        $newUser = new UserEntity();
        $newUser->setCrypto($crypto);

        $fieldset = new UserFieldset();
        $fieldset->setHydrator($hydrator);
        $fieldset->setObject($newUser);

        return $fieldset;
    }
}