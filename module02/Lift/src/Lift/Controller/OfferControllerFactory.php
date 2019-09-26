<?php


namespace Lift\Controller;



use Lift\Repository\OfferRepository;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class OfferControllerFactory implements FactoryInterface
{
    /**
     * Create service
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $repo = $serviceLocator->getServiceLocator()->get(OfferRepository::class);

        return new OfferController($repo);
    }
}