<?php


namespace Lift\Filter;


use Zend\Filter\AbstractFilter;
use Zend\Filter\Callback;
use Zend\Filter\Exception;

class UppercaseFirst extends AbstractFilter
{

    /**
     * Returns the result of filtering $value
     *
     * @param mixed $value
     * @return mixed
     * @throws Exception\RuntimeException If filtering $value is impossible
     */
    public function filter($value)
    {
        return ucfirst($value);
    }
}