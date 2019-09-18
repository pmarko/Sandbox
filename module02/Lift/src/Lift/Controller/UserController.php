<?php


namespace Lift\Controller;


use Lift\Form\UserRegistrationForm;
use Lift\Model\UserModel;
use Zend\Db\Sql\Predicate\In;
use Zend\Debug\Debug;
use Zend\Filter\FilterChain;
use Zend\Filter\StringToUpper;
use Zend\Filter\StringTrim;
use Zend\Form\Element\Password as PasswordElement;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text as TextElement;
use Zend\Form\Form;
use Zend\Form\FormInterface;
use Zend\Hydrator\ClassMethods;
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
    /**
     * @var FormInterface
     */
    private $userRegistrationForm;

    /**
     * UserController constructor.
     * @param FormInterface $userRegistrationForm
     */
    public function __construct(FormInterface $userRegistrationForm)
    {
        $this->userRegistrationForm = $userRegistrationForm;
    }

    public function registerAction()
    {
        if($this->getRequest()->isPost()){

            $postData = $this->params()->fromPost();

            $this->userRegistrationForm->setData($postData);

            if($this->userRegistrationForm->isValid()){

                $cleanData = $this->userRegistrationForm->getData();

                Debug::dump($cleanData);

            }
        }

        $viewModel = new ViewModel();

        $viewModel->setVariable('user_registration_form', $this->userRegistrationForm);

        return $viewModel;
    }
}