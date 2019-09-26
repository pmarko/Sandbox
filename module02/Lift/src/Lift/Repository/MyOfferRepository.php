<?php


namespace Lift\Repository;


use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Lift\Auth\AuthServiceAwareInterface;
use Lift\Entity\OfferEntity;
use Lift\ObjectManager\ObjectManagerAwareInterface;
use mysql_xdevapi\Exception;
use Zend\Authentication\AuthenticationService;
use Zend\Debug\Debug;

class MyOfferRepository implements ObjectManagerAwareInterface, AuthServiceAwareInterface
{
    use FlushableTrait;

    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var AuthenticationService
     */
    private $authService;

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
    public function findAllAsPaginatorAdapter()
    {
        $qb = $this->objectManager
            ->getRepository(OfferEntity::class)
            ->createQueryBuilder('o')
            ->select('o, c')
            ->innerJoin('o.creator', 'c')
            ->orderBy('o.updatedAt', 'DESC')
            ->andWhere('o.creator = :identity')
            ->setParameter('identity', $this->authService->getIdentity());

        $query = $qb->getQuery()->setHydrationMode(Query::HYDRATE_ARRAY);

        return new DoctrinePaginator(new Paginator($query));
    }

    /**
     * @param $id
     * @return object|null
     */
    public function find($id)
    {
        return $this->objectManager
            ->getRepository(OfferEntity::class)
            ->findOneBy(['id' => $id, 'creator' => $this->authService->getIdentity()]);
    }

    /**
     * @param OfferEntity $offer
     * @return $this
     * @throws \Exception
     */
    public function remove(OfferEntity $offer)
    {
        if($offer->getCreator()->getId() != $this->authService->getIdentity()->getId()){
            throw new \Exception("Hackiiiiiiing!");
        }
        $this->objectManager->remove($offer);
        return $this;
    }

    /**
     * @param OfferEntity $newOffer
     * @return $this
     */
    public function persist(OfferEntity $newOffer)
    {
        $newOffer->setCreator($this->authService->getIdentity());
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

    /**
     * @param AuthenticationService $auth
     */
    public function setAuthService(AuthenticationService $auth)
    {
        $this->authService = $auth;
    }
}