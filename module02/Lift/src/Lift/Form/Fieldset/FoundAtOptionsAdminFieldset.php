<?php


namespace Lift\Form\Fieldset;


use Zend\Form\Fieldset;
use Zend\Hydrator\ObjectProperty;
use Zend\InputFilter\InputFilterProviderInterface;

class FoundAtOptionsAdminFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function init()
    {
        $this->add([
            'name' => 'id',
            'type' => 'Hidden'
        ]);

        $this->add([
            'name' => 'label',
            'type' => 'Text',
            'attributes' => [
                'placeholder' => 'Where'
            ]
        ]);

        $this->add([
            'name' => 'remove',
            'type' => 'Button',
            'options' => [
                'label' => 'Remove',
            ],
            'attributes' => [
                'class' => 'remove-btn',
                //'onclick' => 'remove(this);'
            ]
        ]);

        $this->setObject(new \stdClass());

        $this->setHydrator(new ObjectProperty());
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
            'label' => [
                'required' => true,
//                'allow_empty' => false
            ]
        ];
    }
}