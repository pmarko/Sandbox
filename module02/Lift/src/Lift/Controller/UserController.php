<?php


namespace Lift\Controller;


use Zend\Db\Sql\Predicate\In;
use Zend\Debug\Debug;
use Zend\Filter\FilterChain;
use Zend\Filter\StringToUpper;
use Zend\Filter\StringTrim;
use Zend\InputFilter\Factory as InputFilterFactory;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Mvc\Controller\AbstractActionController;


use Zend\Validator\Identical;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;
use Zend\Validator\ValidatorChain;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController
{
    public function registerAction()
    {
        $viewModel = new ViewModel();

        if($this->getRequest()->isPost()){

            $errors = [];

            $postData = $this->params()->fromPost();
            $cleanData = [];

            $isValid = true;

//            $userNameValidators = new ValidatorChain();
//            $userNameValidators->attach(new NotEmpty(), true);
//            $userNameValidators->attach(new StringLength(['max' => 10]));
//            $userNameValidators->attachByName('StringLength', ['max' => 8]);
//
//            $userNameFilters = new FilterChain();
//            $userNameFilters->attach(new StringTrim());
//            $userNameFilters->attach(new StringToUpper());
//
//            $userNameInput = new Input('user_name');
//            $userNameInput->setValidatorChain($userNameValidators);
//            $userNameInput->setFilterChain($userNameFilters);
//
//            $firstNameInput = new Input('first_name');
//            $firstNameInput->setValidatorChain($userNameValidators);
//            $firstNameInput->setFilterChain($userNameFilters);


//            $inputFilter = new InputFilter();
//            $inputFilter->add($userNameInput, 'user_name');
//            $inputFilter->add($firstNameInput, 'first_name');
//            $inputFilter->setData($postData);
            // NEVER NEVER  DO THIS !!!!!!!!!
            $applicationInputFilterManager = @$this->getServiceLocator()->get('InputFilterManager');

            $inputFilterFactory = new InputFilterFactory();
            $inputFilterFactory->setInputFilterManager($applicationInputFilterManager);
            $inputFilter = $inputFilterFactory->createInputFilter([
                'user_name' => [
                    'name' => 'user_name',
                    'validators' => [
                        [
                            'name' => 'NotEmpty'
                        ],
                        [
                            'name' => 'GreaterThan5'
                        ]
                    ],
                    'filters' => [
                        [
                            'name' => 'StringTrim'
                        ],
                        [
                            'name' => 'UppercaseFirst'
                        ]
                    ]
                ],
                'first_name' => [
                    'name' => 'first_name',
                    'validators' => [
                        [
                            'name' => 'NotEmpty'
                        ]
                    ]
                ]
            ]);

            $inputFilter->setData($postData);

            if($inputFilter->isValid()){
                $cleanData = $inputFilter->getValues();
                Debug::dump($cleanData);
            }else{
                $errors = $inputFilter->getMessages();
                Debug::dump($errors);
            }


//            $identicalValidator = new Identical();

//            $identicalValidator->setToken('ccc ');
//            $identicalValidator->setMessages([
//                Identical::NOT_SAME => '%value% is not the same as %token%'
//            ]);

////            $userNameValidator1 = new NotEmpty();
////            $userNameValidator2 = new StringLength(['max' => 10]);
//            if(!$userNameInput->isValid()){
//                $isValid = false;
//                $errors['user_name'] = implode(',', $userNameInput->getMessages());
//            }else{
//               //$cleanData['user_name'] = trim($postData['user_name']);
//               $cleanData['user_name'] = $userNameInput->getValue();
//            }

//            $firstNameValidator = new Identical('ddd ');
//
//            //$identicalValidator->setToken('ddd ');
//            if(!$firstNameValidator->isValid($postData['first_name'])){
//                $isValid = false;
//                $errors['first_name'] = 'Must be ddd';
//            }else{
//                $cleanData['first_name'] = trim($postData['first_name']);
//            }

//            if($isValid){
//                // clean data
//                echo "is valid, save to db";
//
//                Debug::dump($cleanData,
//                    'clean data');
//            }

            $viewModel->setVariables([
                'values' => $postData,
                'errors' => $errors
            ]);

            Debug::dump($postData,
                'post data');

        }else{

            $viewModel->setVariables([
                'values' => ['user_name' => '', 'first_name' => ''],
                'errors' => []
            ]);
        }

        return $viewModel;
    }
}