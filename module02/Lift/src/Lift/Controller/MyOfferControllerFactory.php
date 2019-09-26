<?php


namespace Lift\Controller;



use Lift\Repository\MyOfferRepository;
use Lift\Repository\OfferRepository;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MyOfferControllerFactory implements FactoryInterface
{
    /**
     * Create service
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $repo = $serviceLocator->getServiceLocator()->get(MyOfferRepository::class);

        return new MyOfferController($repo);
    }
}