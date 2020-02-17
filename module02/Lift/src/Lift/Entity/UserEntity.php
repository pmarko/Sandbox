<?php

namespace Lift\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lift\Crypto\CryptoAwareInterface;
use Zend\Crypt\Password\Bcrypt;
use Zend\Crypt\Password\PasswordInterface;
use ZF\OAuth2\Doctrine\Entity\AccessToken;
use ZF\OAuth2\Doctrine\Entity\AuthorizationCode;
use ZF\OAuth2\Doctrine\Entity\Client;
use ZF\OAuth2\Doctrine\Entity\RefreshToken;
use ZF\OAuth2\Doctrine\Entity\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
//class UserEntity implements CryptoAwareInterface
class UserEntity implements UserInterface, \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    private $id;

    /**
     * @var Client
     * @ORM\OneToMany(targetEntity="ZF\OAuth2\Doctrine\Entity\Client", mappedBy="user")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    protected $client;

    /**
     * @var AccessToken
     * @ORM\OneToMany(targetEntity="ZF\OAuth2\Doctrine\Entity\AccessToken", mappedBy="user")
     * @ORM\JoinColumn(name="access_token_id", referencedColumnName="id")
     */
    protected $accessToken;

    /**
     * @var AuthorizationCode
     * @ORM\OneToMany(targetEntity="ZF\OAuth2\Doctrine\Entity\AuthorizationCode", mappedBy="user")
     * @ORM\JoinColumn(name="authorization_code_id", referencedColumnName="id")
     */
    protected $authorizationCode;

    /**
     * @var RefreshToken
     * @ORM\OneToMany(targetEntity="ZF\OAuth2\Doctrine\Entity\RefreshToken", mappedBy="user")
     * @ORM\JoinColumn(name="refresh_token_id", referencedColumnName="id")
     */
    protected $refreshToken;

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
//        return $password == $this->password;
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
            $this->crypto = new Bcrypt();
//            throw new \Exception("No cryptography found");
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

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function getAuthorizationCode()
    {
        return $this->authorizationCode;
    }

    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    // This function is required for the Authentication process.
    // It expects the entity to be used for authentication to implement UserInterface and to implement this function.
    // It is used in ZF\OAuth2\Doctrine\Adapter\DoctrineAdapter class.
    public function getArrayCopy()
    {
        return [
            'id' => $this->getId(),
            'userName' => $this->getUserName(),
            'password' => $this->getPassword(),
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(),
            'role' => $this->getRole(),
        ];
    }


    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return $this->getArrayCopy();
    }
}