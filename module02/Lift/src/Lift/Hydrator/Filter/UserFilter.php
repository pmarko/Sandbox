<?php

namespace Lift\Hydrator\Filter;

use Zend\Hydrator\Filter\FilterInterface;

class UserFilter implements FilterInterface
{

    /**
     * @inheritDoc
     */
    public function filter($property)
    {
        $excludeFields = [
            'password',
        ];

        return (! in_array($property, $excludeFields));
    }
}