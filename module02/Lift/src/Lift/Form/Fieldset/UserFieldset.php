<?php


namespace Lift\Form\Fieldset;


use Lift\Entity\UserEntity;
use Lift\Model\UserModel;
use Zend\Debug\Debug;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\Callback;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

class UserFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function init()
    {
        $this->setHydrator(new ClassMethods());

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
    }

    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return [
            'user_name' => [
                'required' => false,
                'continue_if_empty' => true,
                'validators' => [
                    [
                        'name' => 'StringLength',
                        'break_chain_on_failure' => true,
                        'options' => [
                            'min' => 3,
                            'max' => 20,
                            'messages' => [
                                'stringLengthTooShort' => 'User name is less than %min% characters long',
                                'stringLengthTooLong' => 'User name is more than %max% characters long'
                            ]
                        ],
                    ],
                    [
                        'name' => 'Lift\Validator\UsernameIsUnique',
                        'options' => [
                            'messages' => [
                                'objectFound' => 'Username \'%value%\' already exists!'
                            ]
                        ]
                    ],
                ]
            ],
            'first_name' => [
                'required' => false,
                'continue_if_empty' => true,
                'validators' => [
                    [
                        'name' => 'StringLength',
                        'break_chain_on_failure' => true,
                        'options' => [
                            'min' => 2,
                            'max' => 20,
                            'messages' => [
                                'stringLengthTooShort' => 'First name is less than %min% characters long',
                                'stringLengthTooLong' => 'First name is more than %max% characters long'
                            ]
                        ],
                    ],
                ],
            ],
            'last_name' => [
                'required' => false,
                'continue_if_empty' => true,
                'validators' => [
                    [
                        'name' => 'StringLength',
                        'break_chain_on_failure' => true,
                        'options' => [
                            'min' => 2,
                            'max' => 30,
                            'messages' => [
                                'stringLengthTooShort' => 'Last name is less than %min% characters long',
                                'stringLengthTooLong' => 'Last name is more than %max% characters long'
                            ]
                        ],
                    ],
                ],
            ],
            'password' => [
                'required' => false,
                'continue_if_empty' => true,
                'validators' => [
                    [
                        'name' => 'StringLength',
                        'break_chain_on_failure' => true,
                        'options' => [
                            'min' => 8,
                            'messages' => [
                                'stringLengthTooShort' => 'Password is less than %min% characters long'
                            ]
                        ],
                    ],
                ],
            ],
            'password_confirm' => [
                'validators' => [
                    [
                        'name' => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options' => [
                            'messages' => [
                                'isEmpty' => 'Password confirmation is required'
                            ]
                        ]
                    ],
                    [
                        'name' => 'Callback',
                        'options' => [
                            'callback' => function($value, $context){
                                return $context['password'] == $context['password_confirm'];
                            },
                            'messages' => [
                                'callbackValue' => 'Passwords don\'t match'
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }
}