<?php


namespace Lift\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_registration")
 */
class UserRegistrationEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    private $id;

    /**
     * @var UserEntity
     * @ORM\OneToOne(targetEntity="Lift\Entity\UserEntity", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var \DateTimeInterface
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var WhereFoundOptionEntity
     * @ORM\ManyToOne(targetEntity="Lift\Entity\WhereFoundOptionEntity")
     * @ORM\JoinColumn(name="where_found_option_id", referencedColumnName="id")
     */
    private $whereFound;

    /**
     * UserRegistrationEntity constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->whereFound = new NullWhereFoundOptionEntity();
    }

    /**
     * @param UserEntity $user
     * @return UserRegistrationEntity
     */
    public function setUser(UserEntity $user): self
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return UserEntity|null
     */
    public function getUser(): ?UserEntity
    {
        return $this->user;
    }

    /**
     * @param WhereFoundOptionEntity $whereFound
     * @return UserRegistrationEntity
     */
    public function setWhereFound(WhereFoundOptionEntity $whereFound): UserRegistrationEntity
    {
        $this->whereFound = $whereFound;
        return $this;
    }

    /**
     * @return WhereFoundOptionEntity|null
     */
    public function getWhereFound(): ?WhereFoundOptionEntity
    {
        return $this->whereFound;
    }
}