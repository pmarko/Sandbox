<?php


namespace Lift\Form;


use Lift\Form\Fieldset\FoundAtOptionsAdminFieldset;
use Zend\Form\Form;

class FoundAtOptionsAdminForm extends Form
{
    public function init()
    {
//        $this->add([
//            'name' => 'user_login',
//            'type' => FoundAtOptionsAdminFieldset::class,
//            'options' => [
//                'use_as_base_fieldset' => true
//            ]
//        ]);

        $this->add(array(
            'type' => 'Zend\Form\Element\Collection',
            'name' => 'bananas',
            'options' => array(
                'label' => 'Please choose categories for this product',
                'count' => 1,
                'should_create_template' => true,
                'allow_add' => true,
                'allow_remove' => true,
                'create_new_objects' => true,
                //'template_placeholder' => '__placeholder__',
                'target_element' => array(
                    'type' => FoundAtOptionsAdminFieldset::class,
                ),
            ),
        ));

        $this->add([
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => [
                'value' => 'Save'
            ]
        ]);
    }
}