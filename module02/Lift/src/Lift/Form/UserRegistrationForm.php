<?php


namespace Lift\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class UserRegistrationForm extends Form implements InputFilterProviderInterface
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
            'name' => 'first_name',
            'type' => 'Text',
            'options' => [
                'label' => 'First Name'
            ]
        ]);

        $this->add([
            'name' => 'last_name',
            'type' => 'Text',
            'options' => [
                'label' => 'Last Name'
            ]
        ]);

        $this->add([
            'name' => 'password',
            'type' => 'Password',
            'options' => [
                'label' => 'Password'
            ]
        ]);

        $this->add([
            'name' => 'password_confirm',
            'type' => 'Password',
            'options' => [
                'label' => 'Confirm password'
            ]
        ]);

        $this->add([
            'name' => 'Submit',
            'type' => 'Submit',
            'attributes' => [
                'value' => 'Register'
            ]
        ]);
    }

    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return [
            'user_name' => [
                'validators' => [
                    [
                        'name' => 'StringLength',
                        'options' => [
                            'min' => 10
                        ]
                    ]
                ],
                'filters' => [
                    [
                        'name' => 'UppercaseFirst'
                    ]
                ]
            ]
        ];
    }
}