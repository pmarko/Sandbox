<?php


namespace Client\Mvc\Validator\Policy\Factory;

use Client\Mvc\Validator\Policy\OperationClientPolicyValidator;
use Client\Repository\File\OperationClientFileRepository;
use Client\Repository\OperationClientRepository;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class OperationClientPolicyValidatorFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param $requestedName
     * @param array $options
     */
    public function __invoke($container, $requestedName, array $options = [])
    {
        $repository = $container->get(OperationClientFileRepository::class);
        return new $requestedName($repository);
    }

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator,OperationClientPolicyValidator::class);
    }
}