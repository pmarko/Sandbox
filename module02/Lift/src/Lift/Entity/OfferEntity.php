<?php


namespace Lift\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="offer")
 */
class OfferEntity
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
     * @ORM\ManyToOne(targetEntity="Lift\Entity\UserEntity")
     * @ORM\JoinColumn(name="creator_id", referencedColumnName="id")
     */
    private $creator;

    /**
     * @var string
     * @ORM\Column(name="from_location", type="string", nullable=false, length=255, unique=false)
     */
    private $fromLocation = '';

    /**
     * @var string
     * @ORM\Column(name="to_location", type="string", nullable=false, length=255, unique=false)
     */
    private $toLocation = '';

    /**
     * @var \DateTimeInterface
     * @ORM\Column(name="utc_created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTimeInterface
     * @ORM\Column(name="utc_updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * OfferEntity constructor.
     */
    public function __construct()
    {
        $now = new \DateTimeImmutable();
        $this->createdAt = $now;
        $this->updatedAt = $now;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return UserEntity
     */
    public function getCreator(): ?UserEntity
    {
        return $this->creator;
    }

    /**
     * @param UserEntity $creator
     * @return OfferEntity
     */
    public function setCreator(UserEntity $creator): OfferEntity
    {
        $this->creator = $creator;
        return $this;
    }

    /**
     * @return string
     */
    public function getFromLocation(): string
    {
        return $this->fromLocation;
    }

    /**
     * @param string $fromLocation
     * @return OfferEntity
     */
    public function setFromLocation(string $fromLocation): OfferEntity
    {
        $this->fromLocation = $fromLocation;
        return $this;
    }

    /**
     * @return string
     */
    public function getToLocation(): string
    {
        return $this->toLocation;
    }

    /**
     * @param string $toLocation
     * @return OfferEntity
     */
    public function setToLocation(string $toLocation): OfferEntity
    {
        $this->toLocation = $toLocation;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $createdAt
     * @return OfferEntity
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): OfferEntity
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeInterface $updatedAt
     * @return OfferEntity
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt): OfferEntity
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}