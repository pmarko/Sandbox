<?php


namespace Client\Repository\File;


use Client\Repository\OperationClientRepository;
use Zend\Debug\Debug;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class OperationClientFileRepositoryFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param $requestedName
     * @param array $options
     */
    public function __invoke($container, $requestedName, array $options = [])
    {
        $config = $container->get('Config');

        $path = $config['client']['operation_client_repository_path'];

        return new $requestedName($path);
    }

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator,OperationClientFileRepository::class);
    }
}