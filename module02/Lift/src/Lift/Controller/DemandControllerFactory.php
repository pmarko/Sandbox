<?php


namespace Lift\Controller;



use Lift\Repository\DemandRepository;
use Lift\Repository\OfferRepository;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DemandControllerFactory implements FactoryInterface
{
    /**
     * Create service
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $repo = $serviceLocator->getServiceLocator()->get(DemandRepository::class);

        return new DemandController($repo);
    }
}