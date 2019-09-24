<?php

namespace Lift\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class UserEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="user_name", type="string", nullable=false, length=255, unique=true)
     */
    private $userName = '';

    /**
     * @var string
     * @ORM\Column(name="first_name", type="string", nullable=false, length=255, unique=false)
     */
    private $firstName = '';

    /**
     * @var string
     * @ORM\Column(name="last_name", type="string", nullable=false, length=255, unique=false)
     */
    private $lastName = '';

    /**
     * @var string
     * @ORM\Column(name="password", type="string", nullable=false, length=255, unique=false)
     */
    private $password = '';

    /**
     * @var string
     * @ORM\Column(name="role", type="string", nullable=false, length=255, unique=false)
     */
    private $role = 'user';

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     * @return self
     */
    public function setUserName(string $userName): self
    {
        $this->userName = $userName;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return self
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return self
     */
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }
}