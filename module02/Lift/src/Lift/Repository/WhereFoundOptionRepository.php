<?php
namespace Lift\Repository;


use Doctrine\Common\Persistence\ObjectManager;
use Lift\Entity\WhereFoundOptionEntity;
use Lift\ObjectManager\ObjectManagerAwareInterface;

class WhereFoundOptionRepository implements ObjectManagerAwareInterface
{
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
        return $this->objectManager
            ->getRepository(WhereFoundOptionEntity::class)->findAll();
    }

    /**
     * @param string $id
     * @return object|null
     */
    public function find(string $id)
    {
        return $this->objectManager
            ->getRepository(WhereFoundOptionEntity::class)->find($id);
    }

    /**
     * @param ObjectManager $objectManager
     * @return mixed|void
     */
    public function setObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }
}