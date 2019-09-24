<?php


namespace Lift\Controller;


use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Lift\Hydrator\Strategy\WhereFoundOptionStrategy;
use Lift\Repository\UserRegistrationRepository;
use Lift\Repository\WhereFoundOptionRepository;
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
//        $whereFoundRepo = $this->getServiceLocator()->get(WhereFoundOptionRepository::class);
//
//        $whereFoundStrtegy = new WhereFoundOptionStrategy($whereFoundRepo);
//
//        $this->form->get('user_registration')->getHydrator()->addStrategy('where_found', $whereFoundStrtegy);

        $objectManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $hydrator = new DoctrineObject($objectManager);
        $hydrator->setNamingStrategy(new UnderscoreNamingStrategy());

        $this->form->get('user_registration')->setHydrator($hydrator);

        //$this->form->get('user_registration')->get('user')->setHydrator(new DoctrineObject($objectManager));

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