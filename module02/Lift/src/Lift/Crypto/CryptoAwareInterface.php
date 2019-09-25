<?php


namespace Lift\Crypto;


use Zend\Crypt\Password\PasswordInterface;

interface CryptoAwareInterface
{
    public function setCrypto(PasswordInterface $crypto);
}