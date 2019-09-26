<?php


namespace Lift\Repository;


use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Lift\Entity\OfferEntity;
use Lift\ObjectManager\ObjectManagerAwareInterface;
use Zend\Debug\Debug;

class OfferRepository implements ObjectManagerAwareInterface
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
     * @return array
     */
    public function findAllAsPaginatorAdapter(Criteria $criteria = null)
    {
//        $dql = "SELECT o, c FROM Lift\\Entity\\OfferEntity o INNER JOIN o.creator c ORDER BY o.updatedAt DESC";
//        $query = $this->objectManager->createQuery($dql);
//        $query->setHydrationMode(Query::HYDRATE_ARRAY);

        $qb = $this->objectManager
            ->getRepository(OfferEntity::class)
            ->createQueryBuilder('o')
            ->select('o, c')
            ->innerJoin('o.creator', 'c')
            ->orderBy('o.updatedAt', 'DESC');

        if($criteria){
            $qb->addCriteria($criteria);
        }

        $query = $qb->getQuery()->setHydrationMode(Query::HYDRATE_ARRAY);

        return new DoctrinePaginator(new Paginator($query));
    }

    /**
     * @param OfferEntity $newOffer
     * @return $this
     */
    public function persist(OfferEntity $newOffer)
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