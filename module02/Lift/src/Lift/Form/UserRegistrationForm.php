<?php


namespace Lift\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class UserRegistrationForm extends Form
{
    public function init()
    {
        $this->add([
           'name' => 'user_registration',
           'type' => 'Lift\Form\Fieldset\UserRegistrationFieldset',
            'options' => [
                'use_as_base_fieldset' => true
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => [
                'value' => 'Register'
            ]
        ]);

        $this->setAttribute('class', 'form-horizontal');
    }
}