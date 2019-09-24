<?php


namespace Lift\Validator;


use DoctrineModule\Validator\NoObjectExists;
use DoctrineModule\Validator\ObjectExists;
use DoctrineModule\Validator\UniqueObject;
use Lift\Entity\UserEntity;
use Lift\Entity\WhereFoundOptionEntity;
use Zend\Debug\Debug;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class WhereFoundOptionExistsFactory implements FactoryInterface
{
    /**
     * @var array
     */
    private $options;

    /**
     * UsernameIsUniqueFactory constructor.
     * @param $options
     */
    public function __construct($options = [])
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

        $validator = new ObjectExists(
            array_merge([
                'object_manager' => $objectManager,
                'object_repository' => $objectManager->getRepository(WhereFoundOptionEntity::class),
                'fields' => 'id',
            ], $this->options));

        return $validator;
    }
}