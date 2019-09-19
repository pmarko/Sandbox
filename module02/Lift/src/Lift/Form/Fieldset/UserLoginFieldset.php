<?php


namespace Lift\Form\Fieldset;


use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;

class UserLoginFieldset extends Fieldset
{
    public function init()
    {
        $this->add([
            'name' => 'user_name',
            'type' => 'Text',
            'options' => [
                'label' => 'User Name'
            ]
        ]);

        $this->add([
            'name' => 'password',
            'type' => 'Password',
            'options' => [
                'label' => 'Password'
            ]
        ]);

        $this->setHydrator(new ClassMethods());
    }
}