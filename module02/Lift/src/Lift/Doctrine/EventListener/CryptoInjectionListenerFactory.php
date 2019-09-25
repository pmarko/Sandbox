<?php


namespace Lift\Doctrine\EventListener;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CryptoInjectionListenerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $crypto = $serviceLocator->get('Lift\Crypto\Crypto');
        return new CryptoInjectionListener($crypto);
    }
}