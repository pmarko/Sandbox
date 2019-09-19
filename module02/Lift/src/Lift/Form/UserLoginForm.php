<?php


namespace Lift\Form;


use Lift\Form\Fieldset\UserLoginFieldset;
use Lift\Form\Fieldset\UserRegistrationFieldset;
use Zend\Form\Form;

class UserLoginForm extends Form
{
    public function init()
    {
        $this->add([
            'name' => 'user_login',
            'type' => UserLoginFieldset::class,
            'options' => [
                'use_as_base_fieldset' => true
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => [
                'value' => 'Login'
            ]
        ]);
    }
}