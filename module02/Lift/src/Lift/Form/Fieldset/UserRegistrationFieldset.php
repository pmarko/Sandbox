<?php


namespace Lift\Form\Fieldset;


use Lift\Model\UserModel;
use Lift\Model\UserRegistrationModel;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilterProviderInterface;

class UserRegistrationFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function init()
    {
        $this->setObject(new UserRegistrationModel());
        $this->setHydrator(new ClassMethods());

        $this->add([
            'name' => 'user',
            'type' => 'Lift\Form\Fieldset\UserFieldset',
            'options' => []
        ]);

        $this->add([
            'name' => 'found_at',
            'type' => 'Text',
            'options' => [
                'label' => 'How did you found us?'
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
        return [];
//        return [
//            'user_name' => [
//                'validators' => [
//                    [
//                        'name' => 'StringLength',
//                        'options' => [
//                            'min' => 2
//                        ]
//                    ]
//                ],
//                'filters' => [
//                    [
//                        'name' => 'UppercaseFirst'
//                    ]
//                ]
//            ]
//        ];
    }
}