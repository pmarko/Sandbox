<?php


namespace Lift\Form\Element;

use Lift\Repository\FoundAtOptionsRepo;
use Zend\Config\Config;
use Zend\Config\Reader\Json as JsonReader;
use Zend\Debug\Debug;
use Zend\Form\Element\Select;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class FoundAtSelectFactory implements FactoryInterface
{
    /**
    * Create service
    *
    * @param ServiceLocatorInterface $serviceLocator
    * @return mixed
    */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $optionsRepo = $serviceLocator->getServiceLocator()->get(FoundAtOptionsRepo::class);
        $select = new Select();
        $select->setValueOptions(array_map(function($el){
            return array_merge($el, ['value' => $el['id']]);
        }, $optionsRepo->findAll()));
        return $select;
    }
}