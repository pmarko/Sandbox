<?php

namespace Lift\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lift\Crypto\CryptoAwareInterface;
use Zend\Crypt\Password\PasswordInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class UserEntity implements CryptoAwareInterface
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
     * @var PasswordInterface
     */
    private $crypto;

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
        $this->password = $this->getCrypto()->create($password);
        return $this;
    }

    /**
     * @param string $password
     * @return mixed
     */
    public function verify(string $password)
    {
        return $this->getCrypto()->verify($password, $this->password);
    }

    /**
     * @param PasswordInterface $crypto
     * @return $this
     */
    public function setCrypto(PasswordInterface $crypto)
    {
        $this->crypto = $crypto;
        return $this;
    }

    /**
     * @return PasswordInterface
     * @throws \Exception
     */
    public function getCrypto()
    {
        if(!$this->crypto){
            throw new \Exception("No cryptography found");
        }

        return $this->crypto;
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