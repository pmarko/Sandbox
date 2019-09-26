<?php


namespace Lift\Form\Fieldset;


use Lift\Entity\OfferEntity;
use Lift\Entity\UserEntity;
use Lift\Model\UserModel;
use Zend\Debug\Debug;
use Zend\Form\Fieldset;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\Callback;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

class OfferFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function init()
    {
        $this->setHydrator(new ClassMethods());
        $this->setObject(new OfferEntity());

        $this->add([
            'name' => 'from_location',
            'type' => 'Text',
            'options' => [
                'label' => 'From'
            ]
        ]);

        $this->add([
            'name' => 'to_location',
            'type' => 'Text',
            'options' => [
                'label' => 'To'
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
    }
}