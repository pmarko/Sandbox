<?php


namespace Lift\Repository;


use Doctrine\Common\Persistence\ObjectManager;
use Lift\Entity\UserEntity;
use Lift\ObjectManager\ObjectManagerAwareInterface;

class UserRepository implements ObjectManagerAwareInterface
{
    use FlushableTrait;

    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * UserRepository constructor.
     * @param ObjectManager $objectManager \
     */
    public function __construct(ObjectManager $objectManager = null)
    {
        if($objectManager){
            $this->setObjectManager($objectManager);
        }
    }

    /**
     * @return object[]
     */
    public function findAll()
    {
        return $this->objectManager->getRepository(UserEntity::class)->findAll();
    }

    /**
     * @param UserEntity $newUser
     * @return $this
     */
    public function persist(UserEntity $newUser)
    {
        $this->objectManager->persist($newUser);
        return $this;
    }

    public function setObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }
}