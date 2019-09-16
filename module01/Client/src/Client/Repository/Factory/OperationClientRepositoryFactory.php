<?php


namespace Client\Repository\Factory;

use Client\Repository\OperationClientRepository;
use Zend\Form\Form;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Interop\Container\ContainerInterface;

class OperationClientRepositoryFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param $requestedName
     * @param array $options
     */
    public function __invoke($container, $requestedName, array $options = [])
    {
        return new $requestedName();
    }

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator,OperationClientRepository::class);
    }

}