<?php


namespace Lift\Validator;


use DoctrineModule\Validator\NoObjectExists;
use DoctrineModule\Validator\UniqueObject;
use Lift\Entity\UserEntity;
use Zend\Debug\Debug;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UsernameIsUniqueFactory implements FactoryInterface
{
    /**
     * @var array
     */
    private $options;

    /**
     * UsernameIsUniqueFactory constructor.
     * @param $options
     */
    public function __construct($options)
    {
       $this->options = $options;
    }

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $objectManager = $serviceLocator->getServiceLocator()
            ->get('doctrine.entitymanager.orm_default');

        $validator = new NoObjectExists(
            array_merge([
                'object_manager' => $objectManager,
                'object_repository' => $objectManager->getRepository(UserEntity::class),
                'fields' => 'userName',
            ], $this->options));

        return $validator;
    }
}