<?php
namespace Lift\Doctrine\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Lift\Crypto\CryptoAwareInterface;
use Zend\Crypt\Password\Bcrypt;
use Zend\Crypt\Password\PasswordInterface;

class CryptoInjectionListener implements EventSubscriber
{
    /**
     * @var PasswordInterface
     */
    private $crypto;

    /**
     * CryptoInjectionListener constructor.
     * @param PasswordInterface $crypto
     */
    public function __construct(PasswordInterface $crypto)
    {
        $this->crypto = $crypto;
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     * @return string[]
     */
    public function getSubscribedEvents()
    {
        return [
            Events::postLoad
        ];
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if($entity instanceof CryptoAwareInterface){
            $entity->setCrypto($this->crypto);
        }
    }
}