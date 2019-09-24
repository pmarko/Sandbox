<?php


namespace Lift\Form\Fieldset;


use Lift\Entity\UserEntity;
use Lift\Model\UserModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilterProviderInterface;

class UserFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function init()
    {
        $this->setObject(new UserEntity());
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
                'validators' => [
                    [
                        'name' => 'Lift\Validator\UsernameIsUnique',
                        'options' => [
                            'messages' => [
                                'objectFound' => 'Username \'%value%\' already exists!'
                            ]
                        ]
                    ]
                ]
            ]
//            'user_name' => [
//
//                'validators' => [
//                    [
//                        'name' => 'StringLength',
//                        //'break_chain_on_failure' => true,
//                        'options' => [
//                            'min' => 5
//                        ],
//                    ],
////                    [
//////                        'name' => 'Int',
//////                        'options' => [
//////                            'max' => 100
//////                        ]
////                    ]
//                ],
//                'filters' => [
//                    [
//                        'name' => 'UppercaseFirst'
//                    ]
//                ]
//            ]
        ];
    }
}