<?php


namespace Lift\Hydrator;


use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\Hydrator\NamingStrategy\UnderscoreNamingStrategy;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DoctrineObjectHydratorFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $objectManager = $serviceLocator
                ->getServiceLocator()
                ->get('doctrine.entitymanager.orm_default');
        $hydrator = new DoctrineObject($objectManager);
        $hydrator->setNamingStrategy(new UnderscoreNamingStrategy());
        return $hydrator;
    }
}