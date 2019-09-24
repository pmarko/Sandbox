<?php


namespace Lift\ObjectManager;


use Doctrine\Common\Persistence\ObjectManager;

interface ObjectManagerAwareInterface
{
    /**
     * @param ObjectManager $objectManager
     * @return mixed
     */
    public function setObjectManager(ObjectManager $objectManager);
}