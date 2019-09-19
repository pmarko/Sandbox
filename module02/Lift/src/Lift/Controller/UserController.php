<?php


namespace Lift\Controller;


use Zend\Debug\Debug;
use Zend\Form\FormInterface;
use Zend\Hydrator\ClassMethods;
use Zend\Hydrator\NamingStrategy\MapNamingStrategy;
use Zend\Mvc\Controller\AbstractActionController;


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