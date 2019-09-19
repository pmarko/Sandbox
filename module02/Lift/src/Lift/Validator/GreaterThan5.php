<?php


namespace Lift\Validator;


use Zend\Filter\AbstractFilter;
use Zend\Filter\Exception;
use Zend\Validator\AbstractValidator;
use Zend\Validator\StringLength;

class GreaterThan5 extends AbstractValidator
{
    /**
     * Returns true if and only if $value meets the validation requirements
     *
     * If $value fails validation, then this method returns false, and
     * getMessages() will return an array of messages that explain why the
     * validation failed.
     *
     * @param mixed $value
     * @return bool
     * @throws \Zend\Validator\Exception If validation of $value is impossible
     */
    public function isValid($value)
    {
        $validator = new StringLength(['min' => 5]);
        return $validator->isValid($value);
    }
}
