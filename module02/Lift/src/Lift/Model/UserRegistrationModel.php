<?php


namespace Lift\Model;


class UserRegistrationModel
{
//    /**
//     * @var \DateTimeInterface
//     */
//    private $date;
//
//    /**
//     * @var string
//     */
//    private $ipAddress;
//
    /**
     * @var UserModel
     */
    private $user;

    /**
     * @return UserModel
     */
    public function getUser(): ?UserModel
    {
        return $this->user;
    }

    /**
     * @param UserModel $user
     * @return UserRegistrationModel
     */
    public function setUser(UserModel $user): UserRegistrationModel
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @var string
     */
    private $foundAt = '';

    /**
     * @return string
     */
    public function getFoundAt(): string
    {
        return $this->foundAt;
    }

    /**
     * @param string $foundAt
     * @return $this
     */
    public function setDiscoveredAt(string $foundAt): self
    {
        $this->foundAt = $foundAt;
        return $this;
    }
}