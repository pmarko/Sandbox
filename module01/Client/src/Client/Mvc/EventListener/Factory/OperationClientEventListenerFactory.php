<?php


namespace Client\Mvc\EventListener\Factory;


use Client\Mvc\EventListener\OperationClientEventListener;
use Client\Mvc\Validator\Policy\OperationClientPolicyValidator;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class OperationClientEventListenerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param $requestedName
     * @param array $options
     */
    public function __invoke($container, $requestedName, array $options = [])
    {
        $repository = $container->get(OperationClientPolicyValidator::class);
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
        return $this($serviceLocator,OperationClientEventListener::class);
    }
}