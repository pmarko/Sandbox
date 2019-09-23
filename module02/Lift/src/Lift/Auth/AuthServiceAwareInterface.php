<?php


namespace Lift\Auth;


use Zend\Authentication\AuthenticationService;

interface AuthServiceAwareInterface
{
    public function setAuthService(AuthenticationService $auth);
}