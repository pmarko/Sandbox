<?php


namespace Lift\Auth;


use Lift\Model\UserModel;
use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;

class TestAdapter implements AdapterInterface
{
    /**
     * @var string
     */
    private $userName = '';

    /**
     * @var string
     */
    private $password = '';

    /**
     * TestAdapter constructor.
     * @param string|null $username
     * @param string|null $password
     */
    public function __construct(string $username = '', string $password = '')
    {
        $this->setUserName($username);
        $this->setPassword($password);
    }

    /**
     * @param string $userName
     * @return TestAdapter
     */
    public function setUserName(string $userName): TestAdapter
    {
        $this->userName = $userName;
        return $this;
    }

    /**
     * @param string $password
     * @return TestAdapter
     */
    public function setPassword(string $password): TestAdapter
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Performs an authentication attempt
     *
     * @return \Zend\Authentication\Result
     * @throws \Zend\Authentication\Adapter\Exception\ExceptionInterface If authentication cannot be performed
     */
    public function authenticate()
    {
        if($this->userName == 'admin' && $this->password == 'admin'){
            $user = new UserModel();
            $user->setUserName('admin');
            return new Result(Result::SUCCESS, $user);
        }

        return new Result(Result::FAILURE, null, []);
    }
}