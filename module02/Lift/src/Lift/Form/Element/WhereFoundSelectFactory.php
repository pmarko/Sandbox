<?php


namespace Lift\Form\Element;

use DoctrineModule\Form\Element\ObjectSelect;
use Lift\Entity\WhereFoundOptionEntity;
use Lift\Repository\FoundAtOptionsRepo;
use Zend\Config\Config;
use Zend\Config\Reader\Json as JsonReader;
use Zend\Debug\Debug;
use Zend\Form\Element\Select;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class WhereFoundSelectFactory implements FactoryInterface
{
    /**
    * Create service
    *
    * @param ServiceLocatorInterface $serviceLocator
    * @return mixed
    */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $objectManager = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $select = new ObjectSelect();
        $select->setOptions([
            'object_manager' => $objectManager,
            'target_class' => WhereFoundOptionEntity::class,
            'property' => 'id',
            'label_generator' => function($entity){
                return $entity->getTitle();
            }
        ]);
        return $select;
    }
}