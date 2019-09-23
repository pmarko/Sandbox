<?php


namespace Lift\Model;


class UserModel
{
    /**
     * @var string
     */
    private $userName = '';

    /**
     * @var string
     */
    private $firstName = '';

    /**
     * @var string
     */
    private $lastName = '';

    /**
     * @var string
     */
    private $password = '';

    /**
     * @var string
     */
    private $role = '';

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     * @return UserModel
     */
    public function setUserName(string $userName): UserModel
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
     * @return UserModel
     */
    public function setFirstName(string $firstName): UserModel
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
     * @return UserModel
     */
    public function setLastName(string $lastName): UserModel
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
     * @return UserModel
     */
    public function setPassword(string $password): UserModel
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

    public function scream()
    {
        return $this->getFirstName() . " heeeeeelp!";
    }
}

class UserDelegator extends UserModel
{
    /**
     * @var UserModel
     */
    private $user;

    public function __construct(UserModel $user)
    {
        $this->user = $user;
    }

    public function scream()
    {
        return "delegatedA " . $this->user->scream();
    }
}

class UserBDelegator extends UserModel
{
    /**
     * @var UserModel
     */
    private $user;

    public function __construct(UserModel $user)
    {
        $this->user = $user;
    }

    public function scream()
    {
        return "delegatedB " . $this->user->scream();
    }
}