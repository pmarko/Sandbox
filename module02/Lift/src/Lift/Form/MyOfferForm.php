<?php


namespace Lift\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class MyOfferForm extends Form
{
    public function init()
    {
        $this->add([
           'name' => 'my_offer',
           'type' => 'Lift\Form\Fieldset\OfferFieldset',
            'options' => [
                'use_as_base_fieldset' => true
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => [
                'value' => 'Submit'
            ]
        ]);
    }
}