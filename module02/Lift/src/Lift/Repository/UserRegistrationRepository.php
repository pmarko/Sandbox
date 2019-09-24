<?php


namespace Lift\Repository;


use Doctrine\Common\Persistence\ObjectManager;
use Lift\Entity\UserRegistrationEntity;
use Lift\ObjectManager\ObjectManagerAwareInterface;

class UserRegistrationRepository implements ObjectManagerAwareInterface
{
    use FlushableTrait;

    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @param ObjectManager $objectManager
     */
    public function setObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @param UserRegistrationEntity $newRegistration
     * @return $this
     */
    public function persist(UserRegistrationEntity $newRegistration)
    {
        $this->objectManager->persist($newRegistration);
        return $this;
    }
}