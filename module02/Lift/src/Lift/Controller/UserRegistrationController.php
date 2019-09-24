<?php


namespace Lift\Controller;


use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use DoctrineModule\Validator\UniqueObject;
use Lift\Hydrator\Strategy\WhereFoundOptionStrategy;
use Lift\Repository\UserRegistrationRepository;
use Lift\Repository\WhereFoundOptionRepository;
use Lift\Validator\UsernameIsUniqueFactory;
use Zend\Crypt\Password\Bcrypt;
use Zend\Debug\Debug;
use Zend\Form\FormInterface;
use Zend\Hydrator\NamingStrategy\UnderscoreNamingStrategy;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserRegistrationController extends AbstractActionController
{
    /**
     * @var FormInterface
     */
    private $form;

    /**
     * @var UserRegistrationRepository
     */
    private $repository;

    /**
     * UserRegistrationController constructor.
     * @param FormInterface $form
     * @param UserRegistrationRepository $repository
     */
    public function __construct(FormInterface $form, UserRegistrationRepository $repository)
    {
        $this->form = $form;
        $this->repository = $repository;
    }

    public function registerAction()
    {

        $bCrypt = new Bcrypt(['cost' => 11]);
        echo $hash = $bCrypt->create('password');
        Debug::dump($bCrypt->verify('password', $hash));

        $viewModel = new ViewModel();

        if($this->getRequest()->isPost()){

            $postData = $this->params()->fromPost();

            $this->form->setData($postData);

            if($this->form->isValid()){

                $newUserRegistration = $this->form->getData();

                $this->repository->persist($newUserRegistration);

                $this->repository->flush();

                $viewModel->setTemplate('lift/user-registration/completed');

                return $viewModel;
            }
        }

        $viewModel->setVariable('form', $this->form);

        return $viewModel;
    }
}