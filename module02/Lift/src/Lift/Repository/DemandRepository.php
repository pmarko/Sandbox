<?php


namespace Lift\Repository;


use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Lift\Entity\DemandEntity;
use Lift\ObjectManager\ObjectManagerAwareInterface;

class DemandRepository implements ObjectManagerAwareInterface
{
    use FlushableTrait;

    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * UserRepository constructor.
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager = null)
    {
        if($objectManager){
            $this->setObjectManager($objectManager);
        }
    }

    /**
     * @return array
     */
    public function findAllAsPaginatorAdapter()
    {
        $query = $this->objectManager
            ->getRepository(DemandEntity::class)
            ->createQueryBuilder('o')
            ->select('o, c')
            ->innerJoin('o.creator', 'c')
            ->getQuery()
            ->setHydrationMode(Query::HYDRATE_ARRAY);

        return new DoctrinePaginator(new Paginator($query));
    }

    /**
     * @param DemandEntity $newOffer
     * @return $this
     */
    public function persist(DemandEntity $newOffer)
    {
        $this->objectManager->persist($newOffer);
        return $this;
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